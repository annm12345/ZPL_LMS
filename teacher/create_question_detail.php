<?php
require('top.inc.php');

// Check if user is logged in as teacher
if(isset($_SESSION['TEACHER_LOGIN']) && isset($_POST['create'])){
    $email = $_SESSION['TEACHER_EMAIL'];
}

// Check if question details are provided via GET parameters
if(isset($_GET['id']) && isset($_GET['type']) && isset($_GET['count'])){
    $q_id = $_GET['id'];
    $type = $_GET['type'];
    $count = $_GET['count'];
    
    // Check if form is submitted
    if(isset($_POST['submit_MCQ'])){
        foreach($_POST['question'] as $question_id => $question_data) {
            $question_des = isset($question_data['question_des']) ? $question_data['question_des'] : '';
            $option1 = isset($question_data['option1']) ? $question_data['option1'] : '';
            $option2 = isset($question_data['option2']) ? $question_data['option2'] : '';
            $option3 = isset($question_data['option3']) ? $question_data['option3'] : '';
            $option4 = isset($question_data['option4']) ? $question_data['option4'] : '';
            $answer = isset($question_data['answer']) ? $question_data['answer'] : '';
    
            // Check if any required field is empty
            if(empty($question_des) || empty($option1) || empty($option2) || empty($option3) || empty($option4) || empty($answer)) {
                continue; // Skip this iteration if any required field is empty
            }
    
            // Fetch question ID
            $id = isset($question_data['id']) ? $question_data['id'] : ''; // Updated
    
            // Check if question already exists
            $res = mysqli_query($con, "SELECT * FROM `mcq` where `question_id` = '$q_id' AND `id` = '$id'");
            $check = mysqli_num_rows($res);
    
            if($check > 0) {
                // Update existing question
                $query = "UPDATE `mcq` SET `question_des`='$question_des',`option1`='$option1',`option2`='$option2',`option3`='$option3',`option4`='$option4',`answer`='$answer' WHERE `question_id`='$q_id' AND `id`='$id'";
                mysqli_query($con, $query);
            } else {
                // Insert new question
                $query = "INSERT INTO `mcq`(`question_id`, `id`, `question_des`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES ('$q_id', '$id', '$question_des', '$option1', '$option2', '$option3', '$option4', '$answer')";
                mysqli_query($con, $query);
            }
        }
        ?>
        <script>
            window.location.href="question_list.php?q_id=<?php echo $q_id ?>"; // Redirect after form submission
        </script>
        <?php
        exit; // Stop further execution of the script
    }  

    if(isset($_POST['submit_tf'])){
        foreach($_POST['question'] as $question_id => $question_data) {
            $question_des = isset($question_data['question_des']) ? $question_data['question_des'] : '';
            $answer = isset($question_data['answer']) ? $question_data['answer'] : '';
            $id = $question_id; // Assuming the question ID is set as the key in the $_POST['question'] array

            // Check if any required field is empty
            if(empty($question_des) || empty($answer) || empty($id)) {
                continue; // Skip this iteration if any required field is empty
            }

            // Check if question already exists
            $res = mysqli_query($con, "SELECT * FROM `tf` where `question_id` = '$q_id' AND `id` = '$id'");
            $check = mysqli_num_rows($res);

            if($check > 0) {
                // Update existing question
                $query = "UPDATE `tf` SET `question_des`='$question_des',`answer`='$answer' WHERE `question_id`='$q_id' AND `id`='$id'";
                mysqli_query($con, $query);
            } else {
                // Insert new question
                $query = "INSERT INTO `tf`(`question_id`, `question_des`, `answer`) VALUES ('$q_id', '$question_des', '$answer')";
                mysqli_query($con, $query);
            }
        }
        ?>
        <script>
            window.location.href="question_list.php?q_id=<?php echo $q_id ?>"; // Redirect after form submission
        </script>
        <?php
        exit; // Stop further execution of the script
    }

}
?>

<style>
    .container_form {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .option-group {
        margin-left: 30px;
    }
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .button {
        padding: 10px 20px;
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
    .add-more {
        text-decoration: none;
        padding: 10px 20px;
        font-size: 18px;
        cursor: pointer;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
</style>

<div class="container_form">
    <?php if($type === 'MCQ'): ?>
        <h2>Create Multiple Choice Question</h2>
        <form action="" method="post" id="question-form">
            <div id="form-container">
                <?php 
                // Fetch data for all questions at once
                $res = mysqli_query($con, "SELECT * FROM `mcq` WHERE `question_id` = '$q_id' ");
                $check = mysqli_num_rows($res);
                
                // Loop through the result set
                $i = 1; // Initialize the counter outside the loop
                while($row = mysqli_fetch_assoc($res)) {
                ?>
                    <div class="question-form" id="question<?php echo $i; ?>">
                        <div class="form-group">
                            <label for="question<?php echo $i; ?>">Question <?php echo $i; ?>:</label>
                            <input type="text" id="question<?php echo $i; ?>" name="question[<?php echo $row['id']; ?>][question_des]" style="background:#AAFA7F;" value="<?php echo $row['question_des']; ?>">
                            <input type="hidden" name="question[<?php echo $row['id']; ?>][id]" value="<?php echo $row['id']; ?>">
                        </div>
                        <div class="option-group">
                            <?php for($j = 1; $j <= 4; $j++): ?>
                                <div class="form-group">
                                    <label for="option<?php echo $j; ?><?php echo $i; ?>">Option <?php echo $j; ?>:</label>
                                    <input type="text" id="option<?php echo $j; ?><?php echo $i; ?>" name="question[<?php echo $row['id']; ?>][option<?php echo $j; ?>]" style="width:90%" value="<?php echo $row['option'.$j]; ?>">
                                </div>
                            <?php endfor; ?>
                            <div class="form-group">
                                <label for="answer<?php echo $i; ?>">Answer:</label>
                                <input type="text" id="answer<?php echo $i; ?>" name="question[<?php echo $row['id']; ?>][answer]" style="width:90%" value="<?php echo $row['answer']; ?>">
                            </div>
                        </div>
                    </div>
                <?php 
                    $i++; // Increment the counter inside the loop
                }
                
                // Add additional form fields for remaining questions if needed
                for($j = $i; $j <= $count; $j++): ?>
                    <div class="question-form" id="question<?php echo $j; ?>">
                        <div class="form-group">
                            <label for="question<?php echo $j; ?>">Question <?php echo $j; ?>:</label>
                            <input type="text" id="question<?php echo $j; ?>" name="question[<?php echo $j; ?>][question_des]" style="background:#AAFA7F;">
                        </div>
                        <div class="option-group">
                            <?php for($k = 1; $k <= 4; $k++): ?>
                                <div class="form-group">
                                    <label for="option<?php echo $k; ?><?php echo $j; ?>">Option <?php echo $k; ?>:</label>
                                    <input type="text" id="option<?php echo $k; ?><?php echo $j; ?>" name="question[<?php echo $j; ?>][option<?php echo $k; ?>]" style="width:90%">
                                </div>
                            <?php endfor; ?>
                            <div class="form-group">
                                <label for="answer<?php echo $j; ?>">Answer:</label>
                                <input type="text" id="answer<?php echo $j; ?>" name="question[<?php echo $j; ?>][answer]" style="width:90%">
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>

            <div class="form-group">
                <input type="submit" class="button" name="submit_MCQ" value="Submit">
            </div>
        </form>
    <?php endif; ?>



    <?php if($type === 'TF'): ?>
        <h2>Create True/False Question</h2>
        <form action="" method="post" id="question-form">
            <div id="form-container">
                <?php 
                // Fetch data for all questions at once
                $res = mysqli_query($con, "SELECT * FROM `tf` WHERE `question_id` = '$q_id'");
                $check = mysqli_num_rows($res);
                
                // Loop through the result set
                $i = 1; // Initialize the counter outside the loop
                while($row = mysqli_fetch_assoc($res)) {
                ?>
                    <div class="question-form" id="question<?php echo $i; ?>">
                        <div class="form-group">
                            <label for="question<?php echo $i; ?>">Question <?php echo $i; ?>:</label>
                            <input type="text" id="question<?php echo $i; ?>" name="question[<?php echo $row['id']; ?>][question_des]" value="<?php echo $row['question_des']; ?>" style="background:#AAFA7F;">
                        </div>
                        <div class="option-group">
                            <div class="form-group">
                                <label for="answer<?php echo $i; ?>">Answer <?php echo $i; ?>:</label>
                                <select name="question[<?php echo $row['id']; ?>][answer]" id="answer<?php echo $i; ?>" style="width:90%">
                                    <option value="true" <?php if($row['answer'] == 'true') echo 'selected'; ?>>True</option>
                                    <option value="false" <?php if($row['answer'] == 'false') echo 'selected'; ?>>False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php 
                    $i++; // Increment the counter inside the loop
                }
                
                // Add additional form fields for remaining questions if needed
                for($j = $i; $j <= $count; $j++): ?>
                    <div class="question-form" id="question<?php echo $j; ?>">
                        <div class="form-group">
                            <label for="question<?php echo $j; ?>">Question <?php echo $j; ?>:</label>
                            <input type="text" id="question<?php echo $j; ?>" name="question[<?php echo $j; ?>][question_des]" style="background:#AAFA7F;">
                        </div>
                        <div class="option-group">
                            <div class="form-group">
                                <label for="answer<?php echo $j; ?>">Answer <?php echo $j; ?>:</label>
                                <select name="question[<?php echo $j; ?>][answer]" id="answer<?php echo $j; ?>" style="width:90%">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="form-group">
                <input type="submit" class="button" name="submit_tf" value="Submit">
            </div>
        </form>
    <?php endif; ?>

    <div class="form-group">
        <button class="add-more" onclick="addMore()">Add More</button>
    </div>
</div>

<script>
    function addMore() {
        var container = document.getElementById('form-container');
        var lastForm = container.lastElementChild;
        var clone = lastForm.cloneNode(true);
        var formGroup = clone.querySelectorAll('.form-group');
        var questionNumber = parseInt(clone.id.replace('question', '')) + 1; // Get the last question number and increment
        formGroup.forEach(function(group) {
            var label = group.querySelector('label');
            if(label) {
                label.textContent = label.textContent.replace(/\d+/g, questionNumber); // Update the label text with new question number
            }
            var input = group.querySelector('input');
            if(input) {
                input.value = '';
                input.id = input.id.replace(/\d+/g, questionNumber); // Update the input id with new question number
                input.name = input.name.replace(/\d+/g, questionNumber); // Update the input name with new question number
            }
            var select = group.querySelector('select');
            if(select) {
                select.id = select.id.replace(/\d+/g, questionNumber); // Update the select id with new question number
                select.name = select.name.replace(/\d+/g, questionNumber); // Update the select name with new question number
                select.selectedIndex = 0;
            }
        });
        clone.id = 'question' + questionNumber; // Update the clone id with new question number
        container.appendChild(clone);
    }
</script>

<!-- =========== Scripts =========  -->
<script src="assets/js/main.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>