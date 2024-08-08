<?php
require('top.inc.php');
if(isset($_SESSION['TEACHER_LOGIN'])){
    $email = $_SESSION['TEACHER_EMAIL'];

}
$q_id = [];
if(isset($_GET['id'])){
    $exam_id = $_GET['id'];
    $exam_res = mysqli_query($con, "SELECT * FROM `exam_list` WHERE `id`='$exam_id'");
    $exam_row = mysqli_fetch_assoc($exam_res);
    $paper=$exam_row['course'];
    $paper_row=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `course` where `id`='$paper'"));
    $course=$paper_row['category'];
    $course_row=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `category` where `id`='$course'"));


    
}






?>
    <style>
       
        .button {
            padding: 10px 20px;
            margin: 10px;
            font-size: 18px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* Modal styles */
        .modal {
    
      
            
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            width: 90%;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        /* Form styles */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="datetime-local"],
        input[type="number"],select {
            width: calc(100% - 16px);
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        input[type="number"] {
            width: calc(50% - 10px);
        }

        .form-group div {
            display: inline-flex;
            margin-right: 10px;
        }

        .form-group div:last-child {
            margin-right: 0;
        }

        .form-group label {
            margin-right: 5px;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #45a049;
        }
    </style>

  
    <div id="exam-list-modal" class="modal">
        <div class="modal-content">
 
            <h2>Exam List</h2>
            <table id="exam-table">
                <tr>
                    <th>Stydent</th>
                    <th>Course</th>
                    <th>Paper</th>
                    <th>Exam Title</th>
                    <th>Multiple Choice</th>
                    <th>True & False</th>
                    <th>All Score</th>
                    <th>Note</th>
                    
                     
                </tr>
                <?php
                $student_check = mysqli_query($con, "SELECT DISTINCT `student_id` FROM `take_exam` WHERE `exam_id`='$exam_id'");
                while ($student_check_row = mysqli_fetch_assoc($student_check)) {
                    $student_id = $student_check_row['student_id'];
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
                        <td><?php echo $student_row['name'] ?></td>
                        <td><?php echo $course_row['category'] ?></td>
                        <td><?php echo $paper_row['name'] ?></td>
                        <td><?php echo $exam_row['name'] ?></td>
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
                ?>

                
                  

                

            </table>
        </div>
    </div>
   

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>