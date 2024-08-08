<?php
require('top.inc.php');
if(isset($_GET['id'])){
  $id=get_safe_value($con,$_GET['id']);
  
}
if(isset($_SESSION['STUDENT_LOGIN']) && $_SESSION['STUDENT_LOGIN']!=''){
    $student_id = $_SESSION['STUDENT_ID'];
}
?>



<style>
    .table {
        width: 80%;
        border-collapse: collapse;
        border-spacing: 0;
        background-color: #fff;
        margin:auto;
    }

    .table th,
    .table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #f2f2f2;
        color: #333;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table-responsive {
        overflow-x: auto;
    }

</style>
<main>
    <article>
        <section class="section learning">
            <div class="table-responsive" >
                <table class="table">
                    <thead>
                        <tr>
                            <th>Exam Name</th>
                            <th>Question Type</th>
                            <th>Duration</th>
                            <th>Question Number</th>
                            <th></th>
                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_GET['id'])) {
                            $exam_id = $_GET['id'];
                            $exam_res = mysqli_query($con, "SELECT * FROM `exam_list` WHERE `id`='$exam_id'");
                            $exam_row = mysqli_fetch_assoc($exam_res);
                            $mcq_score_percent=0;
                            $tf_score_percent=0;
                            $question_res = mysqli_query($con, "SELECT * FROM `question` WHERE `exam`='$exam_id'");
                            $count = mysqli_num_rows($question_res);
                            while($row = mysqli_fetch_assoc($question_res)) {
                                $q_id = $row['id'];
                                $type = $row['type'];
                                if($type == 'MCQ') {
                                    $question_detail_res = mysqli_query($con, "SELECT * FROM `mcq` WHERE `question_id`='$q_id'");
                                    $count = mysqli_num_rows($question_detail_res);

                                    $MCQ_check = mysqli_query($con, "SELECT * FROM `take_exam` WHERE `student_id`='$student_id' and `question_id`='$q_id' and `type`='MCQ'");
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
                                    
                                    if($MCQ_count > 0){
                                        $mcq_score_percent = $mcq_score / $MCQ_count * 100;   
                                    }
                                } elseif($type == 'TF') {
                                    $question_detail_res = mysqli_query($con, "SELECT * FROM `tf` WHERE `question_id`='$q_id'");
                                    $count = mysqli_num_rows($question_detail_res);

                                    $TF_check = mysqli_query($con, "SELECT * FROM `take_exam` WHERE `student_id`='$student_id' and `question_id`='$q_id'  and `type`='TF'");
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
                                    if($TF_count > 0){
                                        $tf_score_percent = $tf_score / $TF_count * 100;    
                                    }  
                                }
                                
                        ?>
                                <tr>
                                    <td><?php echo $exam_row['name']; ?></td>
                                    <td><?php 
                                        if($row['type'] == 'MCQ') {
                                            echo "Multiple Choice Question";
                                        } elseif($row['type'] == 'TF') {
                                            echo "True False Question";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['duration']; ?> Minutes</td>
                                    <td><?php echo $count ?></td>
                                    <td>
                                        <?php 
                                        if($row['type'] == 'MCQ') {
                                            if($mcq_score_percent < 63) {
                                                ?>
                                                <a href="take_exam.php?id=<?php echo $row['id']; ?>&type=<?php echo $row['type']; ?>&exam_id=<?php echo $exam_id ?>&duration=<?php echo $row['duration'] ?>" style="background: blue; color: #fff; padding: 0.5rem 1rem; border-radius: 10px; display: inline-block; text-decoration: none;">Take the exam</a></td>
                                                <?php
                                            } else {
                                                echo '';
                                            }
                                        } elseif($row['type'] == 'TF') {
                                            if($tf_score_percent < 63) {
                                                ?>
                                                <a href="take_exam.php?id=<?php echo $row['id']; ?>&type=<?php echo $row['type']; ?>&exam_id=<?php echo $exam_id ?>&duration=<?php echo $row['duration'] ?>" style="background: blue; color: #fff; padding: 0.5rem 1rem; border-radius: 10px; display: inline-block; text-decoration: none;">Take the exam</a></td>
                                                <?php
                                            } else {
                                                echo '';
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        <?php
                        if(isset($_GET['q_id'])) {
                            $q_id = $_GET['q_id'];   
                            $question_res = mysqli_query($con, "SELECT * FROM `question` WHERE `id`='$q_id'");
                            
                            while($row = mysqli_fetch_assoc($question_res)) {
                                $exam_id = $row['exam'];
                                $type = $row['type'];
                                if($type == 'MCQ') {
                                    $question_detail_res = mysqli_query($con, "SELECT * FROM `mcq` WHERE `question_id`='$q_id'");
                                    $count = mysqli_num_rows($question_detail_res);
                                } elseif($type == 'TF') {
                                    $question_detail_res = mysqli_query($con, "SELECT * FROM `tf` WHERE `question_id`='$q_id'");
                                    $count = mysqli_num_rows($question_detail_res);
                                }
                                
                                $exam_res = mysqli_query($con, "SELECT * FROM `exam_list` WHERE `id`='$exam_id'");
                                $exam_row = mysqli_fetch_assoc($exam_res);
                        ?>
                                <tr>
                                    <td><?php echo $exam_row['name']; ?></td>
                                    <td><?php 
                                        if($row['type'] == 'MCQ') {
                                            echo "Multiple Choice Question";
                                        } elseif($row['type'] == 'TF') {
                                            echo "True False Question";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['duration']; ?> Minutes</td>
                                    <td><?php echo $count ?></td>
                                    <td><a href="take_exam.php?id=<?php echo $row['id']; ?>&type=<?php echo $row['type']; ?>&exam_id=<?php echo $exam_id ?>&duration=<?php echo $row['duration'] ?>" style="background: blue; color: #fff; padding: 0.5rem 1rem; border-radius: 10px; display: inline-block; text-decoration: none;">Take the exam</a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                        <!-- Add more rows as needed -->
                                    
                    </tbody>

                </table>
            </div>
        </section>
    </article>
</main>









  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>