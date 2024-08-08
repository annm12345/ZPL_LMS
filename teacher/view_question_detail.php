<?php
require('top.inc.php');


if(isset($_SESSION['TEACHER_LOGIN']) && isset($_POST['create'])){
    $email = $_SESSION['TEACHER_EMAIL'];
   
}
if(isset($_GET['id']) && isset($_GET['type']) && isset($_GET['count'])){
    $q_id=$_GET['id'];
    $type=$_GET['type'];
    $count=$_GET['count'];

    for($i = 1; $i <= $count; $i++) {
        // Retrieve form data for the current question
        $question_des = isset($_POST['question' . $i]) ? $_POST['question' . $i] : '';
        $option1 = isset($_POST['option1' . $i]) ? $_POST['option1' . $i] : '';
        $option2 = isset($_POST['option2' . $i]) ? $_POST['option2' . $i] : '';
        $option3 = isset($_POST['option3' . $i]) ? $_POST['option3' . $i] : '';
        $option4 = isset($_POST['option4' . $i]) ? $_POST['option4' . $i] : '';
        $answer = isset($_POST['answer' . $i]) ? $_POST['answer' . $i] : ''; // If this is a multiple choice question
        
        // Check if the question or any of the options are empty
        if(!empty($question_des) && !empty($option1) && !empty($option2) && !empty($option3) && !empty($option4) && !empty($answer)) {
            // Insert data into the database
            $query = "INSERT INTO `mcq`(`question_id`, `question_des`, `option1`, `option2`, `option3`, `option4`, `answer`) 
                    VALUES ('$q_id', '$question_des', '$option1', '$option2', '$option3', '$option4', '$answer')";
            mysqli_query($con, $query);
            ?>
            <script>
                window.location.href='exam_list.php';
            </script>
            <?php
        }
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
    <div style="margin-bottom: 1rem;">
        <a href="create_question_detail.php?id=<?php echo $q_id ?>&type=<?php echo $type ?>&count=<?php echo $count ?>" class="button">Edit question</a>
    </div>

    <?php if($type === 'MCQ'): ?>
        <h2>Create Multiple Choice Question</h2>
        <form action="" method="post" id="question-form">
        <div id="form-container">
            <?php 
            // Fetch data for all questions at once
            $res = mysqli_query($con, "SELECT * FROM `mcq` WHERE `question_id` = '$q_id' ");
            $check = mysqli_num_rows($res);
            
            // Check if the query returned any rows
            if($check > 0) {
                // Loop through the result set
                $i = 1; // Initialize the counter outside the loop
                while($row = mysqli_fetch_assoc($res)) {
            ?>
                    <div class="question-form" id="question<?php echo $i; ?>">
                        <div class="form-group">
                            <label for="question<?php echo $i; ?>">Question <?php echo $i; ?>:</label>
                            <input type="text" id="question<?php echo $i; ?>" name="question<?php echo $i; ?>" style="background:#AAFA7F;" value="<?php echo $row['question_des']; ?>">
                        </div>
                        <div class="option-group">
                            <div class="form-group">
                                <label for="option1<?php echo $i; ?>">Option 1:</label>
                                <input type="text" id="option1<?php echo $i; ?>" name="option1<?php echo $i; ?>" style="width:90%" value="<?php echo $row['option1']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="option2<?php echo $i; ?>">Option 2:</label>
                                <input type="text" id="option2<?php echo $i; ?>" name="option2<?php echo $i; ?>" style="width:90%" value="<?php echo $row['option2']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="option3<?php echo $i; ?>">Option 3:</label>
                                <input type="text" id="option3<?php echo $i; ?>" name="option3<?php echo $i; ?>" style="width:90%" value="<?php echo $row['option3']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="option4<?php echo $i; ?>">Option 4:</label>
                                <input type="text" id="option4<?php echo $i; ?>" name="option4<?php echo $i; ?>" style="width:90%" value="<?php echo $row['option4']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="answer<?php echo $i; ?>">Answer:</label>
                                <input type="text" id="answer<?php echo $i; ?>" name="answer<?php echo $i; ?>" style="width:90%" value="<?php echo $row['answer']; ?>">
                            </div>
                        </div>
                    </div>
            <?php 
                    $i++; // Increment the counter inside the loop
                }
            }
            ?>
        </div>

</div>

            
        </form>
    <?php elseif($type === 'TF'): ?>
        <h2>Create True/False Question</h2>
        <form action="" method="post" id="question-form">
            <div id="form-container">
                <?php 
                    // Fetch data for all questions at once
                    $res = mysqli_query($con, "SELECT * FROM `tf` WHERE `question_id` = '$q_id' ");
                    $check = mysqli_num_rows($res);
                    
                    // Loop through the result set
                    $i = 1; // Initialize the counter outside the loop
                    while($row = mysqli_fetch_assoc($res)) {
                ?>
                    <div class="question-form" id="question<?php echo $i; ?>">
                        <div class="form-group">
                            <label for="question<?php echo $i; ?>">Question <?php echo $i; ?>:</label>
                            <input type="text" id="question<?php echo $i; ?>" name="question[<?php echo $i; ?>][question_des]" style="background:#AAFA7F;" value="<?php echo $row['question_des']; ?>">
                        </div>
                        <div class="option-group">
                            <div class="form-group">
                                <label for="answer<?php echo $i; ?>">Answer <?php echo $i; ?>:</label>
                                <select name="question[<?php echo $i; ?>][answer]" id="answer<?php echo $i; ?>" style="width:90%">
                                    <option value="true" <?php if($row['answer'] == 'true') echo 'selected'; ?>>True</option>
                                    <option value="false" <?php if($row['answer'] == 'false') echo 'selected'; ?>>False</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php 
                        $i++; // Increment the counter inside the loop
                    }
                    ?>
            </div>
           
        </form>
    <?php endif; ?>
   
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