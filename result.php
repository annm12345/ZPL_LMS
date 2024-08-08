<?php 
require('top.inc.php');
?>
<style>
    .grid-list{
        width:100%;
        display:grid;
        grid-template-columns:1rem;

    }
    table{
        width:100%;
        border-collapse:collapse;
    }
    tr th, tr td{
        border:1px solid black;
        padding:0.5rem;
    }
</style>
<section class="section " aria-label="enroll-list">
        <div class="container">
        <p class="section-subtitle">Result List</p>

        <h2 class="h2 section-title">Here Your Exam Results!</h2>
          
        <table>
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Paper</th>
                    <th>Exam Title</th>
                    <th>Multiple Choice</th>
                    <th>True & False</th>
                    <th>All Score</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if(isset($_GET['id'])){
                    $student_id = get_safe_value($con, $_GET['id']);
                    $student_check = mysqli_query($con, "SELECT DISTINCT `take_exam`.`student_id`, `take_exam`.`exam_id`, `exam_list`.`id`, `exam_list`.`action` 
                                    FROM `take_exam` 
                                    INNER JOIN `exam_list` ON `exam_list`.`id` =`take_exam`.`exam_id` 
                                    WHERE `take_exam`.`student_id` = '$student_id' AND `exam_list`.`action` = '0'");
                    
                    while ($student_check_row = mysqli_fetch_assoc($student_check)) {
                        $student_id = $student_check_row['student_id'];
                        $exam_id=$student_check_row['exam_id'];
                        $exam_res = mysqli_query($con, "SELECT * FROM `exam_list` WHERE `id`='$exam_id'");
                        $exam_row = mysqli_fetch_assoc($exam_res);
                        $paper=$exam_row['course'];
                        $paper_row=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `course` where `id`='$paper'"));
                        $course=$paper_row['category'];
                        $course_row=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `category` where `id`='$course'"));
                        $MCQ_check = mysqli_query($con, "SELECT * FROM `take_exam` WHERE `student_id`='$student_id' and `exam_id`='$exam_id' and `type`='MCQ'");
                        $MCQ_count = mysqli_num_rows($MCQ_check);
                        $mcq_score = 0; // Initialize MCQ score for each student
                        while ($MCQ_row = mysqli_fetch_assoc($MCQ_check)) {
                            $question_des = $MCQ_row['question_des'];
                            $answer = $MCQ_row['answer'];
                            $mark_query = mysqli_query($con, "SELECT * FROM `mcq` WHERE `question_des`='$question_des'");
                            $mark = mysqli_fetch_assoc($mark_query);
                            if ($mark['answer'] === $answer) {
                                $mcq_score++; // Increment score if answer is correct
                            }
                        }

                        $TF_check = mysqli_query($con, "SELECT * FROM `take_exam` WHERE `student_id`='$student_id' and `exam_id`='$exam_id'  and `type`='TF'");
                        $TF_count = mysqli_num_rows($TF_check);
                        $tf_score = 0; // Initialize TF score for each student
                        while ($TF_row = mysqli_fetch_assoc($TF_check)) {
                            $question_des = $TF_row['question_des'];
                            $answer = $TF_row['answer'];
                            $mark_tf_query = mysqli_query($con, "SELECT * FROM `tf` WHERE `question_des`='$question_des'");
                            $mark_tf = mysqli_fetch_assoc($mark_tf_query);
                            if ($mark_tf['answer'] === $answer) {
                                $tf_score++; // Increment score if answer is correct
                            }
                        }
                        
                        if($MCQ_count>0 and $TF_count>0){
                            $mcq_score_percent=$mcq_score / $MCQ_count * 100;
                            $tf_score_percent=$tf_score / $TF_count * 100;
                            $allscore=($mcq_score_percent+$tf_score_percent)/2;
                            
                        }
                        elseif($MCQ_count>0){
                            $mcq_score_percent=$mcq_score / $MCQ_count * 100;   
                            $allscore=$mcq_score_percent;                         
                        }elseif($TF_count>0){
                            $tf_score_percent=$tf_score / $TF_count * 100;
                            $allscore=$tf_score_percent;
                                
                        }
        

                        if($allscore>=97){
                            $grading='A+';
                        }
                        elseif($allscore>=93){
                            $grading='A';
                        }elseif($allscore>=90){
                            $grading='A-';
                        }elseif($allscore>=87){
                            $grading='B+';
                        }elseif($allscore>=83){
                            $grading='B';
                        }elseif($allscore>=80){
                            $grading='B-';
                        }elseif($allscore>=77){
                            $grading='C+';
                        }elseif($allscore>=73){
                            $grading='C';
                        }elseif($allscore>=70){
                            $grading='C-';
                        }elseif($allscore>=67){
                            $grading='D+';
                        }elseif($allscore>=63){
                            $grading='D';
                        }elseif($allscore>=60){
                            $grading='D-';
                        }elseif($allscore>=0){
                            $grading='F';
                        }
                        // Fetch student data
                        $student_row = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `student` WHERE `id`='$student_id'"));
                    ?>
                        <tr>
                            <td><?php echo $course_row['category']; ?></td>
                            <td><?php echo $paper_row['name'] ?></td>
                            <td><?php echo $exam_row['name']; ?></td>
                            <td><?php if ($MCQ_count > 0) {
                                echo $mcq_score_percent;
                            } ?> %</td>
                            <td><?php if ($TF_count > 0) {
                                echo $tf_score_percent;
                            } ?> %</td>
                            <td><?php echo $allscore ?> %</td>
                            <td><?php echo $grading ?></td>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>

        </div>
      </section>

      <?php
require('foot.php');
?>