<?php
require('top.inc.php');
if(isset($_SESSION['STUDENT_LOGIN']) && $_SESSION['STUDENT_LOGIN']!=''){
    $student_id = $_SESSION['STUDENT_ID'];
    if(isset($_GET['id']) && isset($_GET['type'])){
        $q_id = $_GET['id'];
        $type = $_GET['type'];
        $exam_id = $_GET['exam_id'];
        $duration=$_GET['duration'];
        if($type == 'MCQ' || $type == 'TF'){
            if(isset($_POST['submit'])){
                foreach($_POST as $key => $value) {
                    if(strpos($key, 'q') === 0) {
                        // Extract question number from key
                        $question_number = substr($key, 1);
                        // Get the question description and answer
                        $question_des = mysqli_real_escape_string($con, $_POST['question_des'.$question_number]);
                        $answer = mysqli_real_escape_string($con, $_POST[$key]);
                        // Check if both question description and answer are not empty
                        if(!empty($question_des) && !empty($answer)) {
                            date_default_timezone_set('Asia/Yangon');
                            $added_on = date('Y-m-d h:i:s');
                            $check=mysqli_num_rows(mysqli_query($con,"SELECT * FROM `take_exam` where `student_id`='$student_id' and `question_id`='$q_id' and `question_des`='$question_des'"));
                            if($check>0){
                                $query = "UPDATE `take_exam` SET `student_id`='$student_id',`exam_id`='$exam_id',`question_id`='$q_id',`question_des`='$question_des',`answer`='$answer',`type`='$type',`added_on`='$added_on' WHERE `student_id`='$student_id' and `question_id`='$q_id' and `question_des`='$question_des'";
                                // Execute the query
                                mysqli_query($con, $query);
                            }else{
                                $query = "INSERT INTO `take_exam`(`student_id`,`exam_id`, `question_id`, `question_des`, `answer`, `type`, `added_on`) VALUES ('$student_id','$exam_id', '$q_id', '$question_des', '$answer', '$type', '$added_on')";
                                // Execute the query
                                mysqli_query($con, $query);
                            }
                            ?>
                            <script>
                                window.location.href='question_list.php?id=<?php echo $exam_id ?>'
                            </script>
                            <?php
                            
                        }
                    }
                }
            }
        }
        
    }
}
?>

<!-- Modified style and added JavaScript for timer -->
<style>
    .container_form {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .question {
            margin-bottom: 20px;
        }
        .question p {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .options {
            margin-left: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
</style>

<main>
    <article>
        <section class="section learning">
            <div class="container_form">
                <h2>
                    <?php
                    $question_res = mysqli_query($con, "SELECT * FROM `question` WHERE `id`='$q_id'");
                    $row = mysqli_fetch_assoc($question_res);
                    $exam_id = $row['exam'];
                    $exam_res = mysqli_query($con, "SELECT * FROM `exam_list` WHERE `id`='$exam_id'");
                    $exam_row = mysqli_fetch_assoc($exam_res);
                    echo $exam_row['name'];
                    ?>
                </h2>
                <div id="timer">Time Remaining: <?php echo $duration ?> minutes</div>
                <script>
                    var duration = <?php echo $duration ?> * 60; 
                     // Function to update timer and check if time is up
                    function updateTimer() {
                        var hours = Math.floor(duration / 3600); // Calculate hours
                        var minutes = Math.floor((duration % 3600) / 60); // Calculate remaining minutes
                        var seconds = duration % 60; // Calculate remaining seconds

                        // Format the time to display as HH:MM:SS
                        var timeString = '';
                        if (hours > 0) {
                            timeString += hours.toString().padStart(2, '0') + ':';
                        }
                        timeString += minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
                        
                        // Update the timer element with the formatted time
                        document.getElementById('timer').innerHTML = 'Time Remaining: ' + timeString;

                        
                        duration--; // Decrement the remaining time
                    }

                    // Call updateTimer function initially
                    updateTimer();

                    // Call updateTimer function every second
                    var timer = setInterval(updateTimer, 1000);
                </script>
                <form action="" method="post" id="examForm">
                    <?php
                    if($type=='MCQ' || $type=='TF'){
                        $table_name = ($type == 'MCQ') ? 'mcq' : 'tf';
                        $res = mysqli_query($con, "SELECT * FROM `$table_name` WHERE `question_id` = '$q_id' ORDER BY RAND()");
                        $check = mysqli_num_rows($res);
                        
                        // Check if the query returned any rows
                        if($check > 0) {
                            // Loop through the result set
                            $i = 1; // Initialize the counter outside the loop
                            while($row = mysqli_fetch_assoc($res)) {
                                ?>
                                <div class="question">
                                    <p>Question <?php echo $i ?>: <?php echo $row['question_des'] ?></p>
                                    <!-- Ensure that the input field for question description has the correct name -->
                                    <input type="hidden" name="question_des<?php echo $i ?>" value="<?php echo $row['question_des'] ?>">
                                    <div class="options">
                                        <?php
                                        // Generate radio buttons for MCQ or TF questions
                                        if($type == 'MCQ'){
                                            echo '<label>A :<input type="radio" name="q'.$i.'" value="'.$row['option1'].'" required>'.$row['option1'].'</label>';
                                            echo '<label>B :<input type="radio" name="q'.$i.'" value="'.$row['option2'].'" required>'.$row['option2'].'</label>';
                                            echo '<label>C :<input type="radio" name="q'.$i.'" value="'.$row['option3'].'" required>'.$row['option3'].'</label>';
                                            echo '<label>D :<input type="radio" name="q'.$i.'" value="'.$row['option4'].'" required>'.$row['option4'].'</label>';
                                        } elseif($type == 'TF'){
                                            echo '<label><input type="radio" name="q'.$i.'" value="true" required> True</label>';
                                            echo '<label><input type="radio" name="q'.$i.'" value="false" required> False</label>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php 
                                $i++;
                            } 
                        }
                    }
                    ?>
                    <button type="submit" id="submitButton" name="submit">Submit Exam</button>
                </form>
            </div>

        </section>
    </article>
</main>

<!-- JavaScript for timer and preventing premature navigation -->
<script>
     var duration = <?php echo $duration ?> * 60; // Convert minutes to seconds

    // Function to submit the form when time is up
    // Function to submit the form when time is up
    function submitFormWhenTimeIsUp() {
        document.getElementById('submitButton').click(); // Trigger click event on the hidden submit button
    }

    // Calculate the remaining time and submit the form when time is up
    setTimeout(submitFormWhenTimeIsUp, duration * 1000);

    // Function to update timer and check if time is up
    function updateTimer() {
       

        // Check if the time is up
        if (duration <= 0) {
            clearInterval(timer);
            submitFormWhenTimeIsUp(); // Submit the form when time is up
        }

        duration--; // Decrement the remaining time
    }

    // Call updateTimer function initially
    updateTimer();

    // Call updateTimer function every second
    var timer = setInterval(updateTimer, 1000);


</script>


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
