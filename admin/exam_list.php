<?php
require('top.inc.php');


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
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            width: 67%;         
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .modal-content-list {
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

    <!-- <div class="container" style="display:flex;flex-wrap:wrap;">
    
        <button class="button" id="create-exam">Create Exam</button>
        <a href="create_question.php" class="button" style="text-decoration: none;">New Insert Question</a>
    </div> -->
    <div id="exam-list-modal" class="">
        <div class="modal-content-list" >
       
            <h2>Exam List</h2>
            <table id="exam-table">
                <tr>
                    <th>Exam Name</th>
                    <th>Exam Paper</th>
                    <th>Examiner Teacher</th>
                    <th>Exam Date</th>
                    <th colspan="3"></th>
                    
                     
                </tr>
                <?php
                    if(isset($_SESSION['TEACHER_LOGIN'])){
                    $email = $_SESSION['TEACHER_EMAIL'];
                    $res = mysqli_query($con, "SELECT * FROM `exam_list` order by `date` ASC");
                    while($row = mysqli_fetch_assoc($res)){
                        $course=$row['course'];
                        $email=$row['email'];
                        $course_row=mysqli_fetch_assoc( mysqli_query($con, "SELECT * FROM `course` WHERE id='$course'"));
                        $teacher_row=mysqli_fetch_assoc( mysqli_query($con, "SELECT * FROM `teacher` WHERE email='$email'"));

                ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $course_row['name'] ?></td>
                    <td><?php echo $teacher_row['name'] ?></td>
                    <td><?php echo $row['date'] ?></td>
                    <td><a href="exam_result.php?id=<?php echo $row['id'] ?>" style="background: blue; color: #fff; padding: 0.5rem 1rem; border-radius: 10px; display: inline-block; text-decoration: none;">Exam result</a></td>
                </tr>
                <?php
                    }
                }
                ?>
                

            </table>
        </div>
    </div>
    <div id="create-exam-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Create Exam</h2>
            <form action="" method="post" id="create-exam-form">
                <div class="form-group">
                    <label for="exam-name">Exam Name:</label>
                    <input type="text" id="exam-name" name="exam_name" required>
                </div>
                <div class="form-group">
                    <label for="exam-paper">Exam Paper:</label>
                    <select name="exam_paper" required>
                        <option value="">Select Exam Paper</option>
                        <?php
                        if(isset($_SESSION['TEACHER_LOGIN'])){
                            $email = $_SESSION['TEACHER_EMAIL'];
                            $res = mysqli_query($con, "SELECT * FROM `course` WHERE email='$email'");
                            while($row = mysqli_fetch_assoc($res)){
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exam-date">Exam Date:</label>
                    <input type="datetime-local" id="exam-date" name="exam_date" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="button" name="create_exam" value="Create">
                </div>
            </form>
        </div>
    </div>


    <script>
        

        // Function to fill exam list dynamically (for demonstration purpose)
        
        // Call the function to fill exam list when modal is opened
        
        document.getElementById('create-exam').addEventListener('click', function() {
            // Show the create exam modal
            document.getElementById('create-exam-modal').style.display = "block";
        });

        // Add event listener to close buttons
        document.querySelectorAll('.close').forEach(function(closeBtn) {
            closeBtn.addEventListener('click', function() {
                // Close the modal
                this.parentElement.parentElement.style.display = "none";
            });
        });

        // Function to handle form submission (for demonstration purpose)
        document.getElementById('create-exam-form').addEventListener('submit', function(event) {
       
            
            document.getElementById('create-exam-modal').style.display = "none";
           
        });
    </script>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>