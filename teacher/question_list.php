<?php
require('top.inc.php');
if(isset($_GET['id']) && isset($_GET['action']) && isset($_GET['exam_id'])){
    $id=$_GET['id'];
    $action=$_GET['action'];
    $exam_id=$_GET['exam_id'];
    if($action=='delete'){
        mysqli_query($con,"DELETE FROM `question` WHERE `id`='$id'");
        ?>
        <script>
            window.location.href='question_list.php?id=<?php echo $exam_id ?>';
        </script>
        <?php
    }
}
?>

<style>
    /* Styles for the table */
    .container_form {
        max-width: 1020px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow-x: auto; /* Enable horizontal scrolling on small screens */
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    th {
        background-color: #f2f2f2;
    }
    
    /* Responsive table styles */
    @media screen and (max-width: 600px) {
        table {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
        }
    }
</style>

<div class="container_form">
    <table>
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
                    
                    $question_res = mysqli_query($con, "SELECT * FROM `question` WHERE `exam`='$exam_id'");
                    $count=mysqli_num_rows($question_res);
                    while($row = mysqli_fetch_assoc($question_res)) {
                        $q_id=$row['id'];
                        $type=$row['type'];
                        if($type=='MCQ'){
                        $question_detail_res = mysqli_query($con, "SELECT * FROM `mcq` WHERE `question_id`='$q_id'");
                        $count=mysqli_num_rows($question_detail_res);
                        }elseif($type=='TF'){
                            $question_detail_res = mysqli_query($con, "SELECT * FROM `tf` WHERE `question_id`='$q_id'");
                        $count=mysqli_num_rows($question_detail_res);
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
                            <td><a href="view_question_detail.php?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>&count=<?php echo $row['count'] ?>"><i class="fa-solid fa-eye" style="color:green;padding:0.5rem;font-size:1rem;"></i></a> 

                            <a href=""><a href="question_list.php?id=<?php echo $row['id'] ?>&exam_id=<?php echo $exam_id ?>&action=delete"> <i class="fa-solid fa-trash" style="color:red;padding:0.5rem;font-size:1rem;"></i> </a></td>
                            
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
                        $exam_id=$row['exam'];
                        $type=$row['type'];
                        if($type=='MCQ'){
                        $question_detail_res = mysqli_query($con, "SELECT * FROM `mcq` WHERE `question_id`='$q_id'");
                        $count=mysqli_num_rows($question_detail_res);
                        }elseif($type=='TF'){
                            $question_detail_res = mysqli_query($con, "SELECT * FROM `tf` WHERE `question_id`='$q_id'");
                        $count=mysqli_num_rows($question_detail_res);
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
                            <td><a href="view_question_detail.php?id=<?php echo $row['id'] ?>&type=<?php echo $row['type'] ?>&count=<?php echo $row['count'] ?>"><i class="fa-solid fa-eye" style="color:green;padding:0.5rem;font-size:1rem;"></i></a></td>
                            
                        </tr>
                <?php
                    }
                }
                ?>

            
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>

<!-- =========== Scripts =========  -->
<script src="assets/js/main.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>