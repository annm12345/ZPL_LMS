<?php
require('top.inc.php');


if(isset($_SESSION['TEACHER_LOGIN']) && isset($_POST['create'])){
    $email = $_SESSION['TEACHER_EMAIL'];
    $type = $_POST['question_type'];
    $exam = $_POST['exam'];
    $question_duration = $_POST['question_duration'];
    $question_number = $_POST['question_number'];
    date_default_timezone_set('Asia/Yangon');
    $added_on = date('Y-m-d H:i:s');
    
    $sql = "INSERT INTO `question`(`exam`, `type`, `duration`, `count`, `added_on`) VALUES ('$exam','$type','$question_duration','$question_number','$added_on')";
    if(mysqli_query($con, $sql)){
        $insert_id = mysqli_insert_id($con);
        ?>
        <script>
            window.location.href = "create_question_detail.php?id=<?php echo $insert_id ?>&type=<?php echo $type ?>&count=<?php echo $question_number ?>";
        </script>
        <?php
    } else {
        echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
    }
}
?>


<style>
    .container_form {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    h2 {
        margin-top: 0;
        color: #333;
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="number"],
    select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 12px 20px;
        font-size: 18px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>


<div class="container_form">
    <h2>Create Question</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="question-type">Question Type:</label>
            <select name="question_type" id="question-type" required>
                <option value="">Select Question Type</option>
                <option value="MCQ">Multiple Choice</option>
                <option value="TF">True & False</option>
            </select>
        </div>
        <div class="form-group">
                    <label for="exam-paper">Exam Title:</label>
                    <select name="exam" required>
                        <option value="">Select Exam</option>
                        <?php
                        if(isset($_SESSION['TEACHER_LOGIN'])){
                            $email = $_SESSION['TEACHER_EMAIL'];
                            $res = mysqli_query($con, "SELECT * FROM `exam_list` WHERE email='$email'");
                            while($row = mysqli_fetch_assoc($res)){
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
        <div class="form-group">
            <label for="question-duration">Question Duration (minutes):</label>
            <input type="number" id="question-duration" name="question_duration" min="1" required>
        </div>
        <div class="form-group">
            <label for="question-number">Question Number:</label>
            <input type="number" id="question-number" name="question_number" min="1" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Create Question" name="create">
        </div>
    </form>
</div>
<!-- =========== Scripts =========  -->
<script src="assets/js/main.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>