<?php
require('top.inc.php');
$name='';
$bedge='';
$date='';
$description='';
$type='';
if(isset($_SESSION['TEACHER_LOGIN'])){
    $email=$_SESSION['TEACHER_EMAIL'];
if(isset($_POST['add'])){
$name=get_safe_value($con,$_POST['name']);
$bedge=get_safe_value($con,$_POST['bedge']);
$date=get_safe_value($con,$_POST['date']);
$description=get_safe_value($con,$_POST['description']);
$type=get_safe_value($con,$_POST['type']);
mysqli_query($con,"INSERT INTO `schedule`(`email`,`name`, `badge`, `date`, `description`, `type`) VALUES ('$email','$name','$bedge','$date','$description','$type')");

?>
<script>
    window.location.href='calendar.php';
</script>
<?php

} }
?>
            <!-- ================ Order Details List ================= -->
            <style>
                .details{
                    display: grid;
                    grid-template-columns: 1fr;
                }
                a{
                    text-decoration: none;
                }
                form{
                    margin-top: 3rem;
                    width: 100%;
                    display: flex;
                    flex-direction: column;
                    gap: 1rem;
                }
                form input{
                    width: 100%;
                    padding: 1rem 0.5rem;
                    border: 1px solid gray;
                    border-radius: 1rem;
                    font-size: 1rem;
                }
                form input[type="submit"]{
                    width: 10%;
                    background-color: #cadf90;
                    color: blue;
                    border: none;
                    transition: all 400ms ease;
                }form input[type="submit"]:hover{
                    background-color: blue;
                    color: #fff;
                }
                select {
                    width: 100%;
                    padding: 1rem 0.5rem;
                    border: 1px solid gray;
                    border-radius: 1rem;
                    font-size: 1rem;
                    margin-bottom:1rem;
                }
                @media screen and (max-width:600px) {
                    form input[type="submit"]{
                    width: 40%;
                    }
                }
            </style>
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Add Schedule</h2>
                    </div>
                    <form action="" method="post">
                        <div>
                                <select name="name" required>
                                <option value="">Select Course</option>
                                <?php
                                if(isset($_SESSION['TEACHER_LOGIN'])){
                                    $email=$_SESSION['TEACHER_EMAIL'];
                                        $res=mysqli_query($con,"SELECT * FROM `course` where email='$email' ");
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            
                                                echo "<option value=".$row['id'].">".$row['name']."</option>";
                                            
                                        } }
                                    ?>
                        </div>
                        <div>
                            <input type="text" name="bedge" placeholder="Enter the level" required>
                        </div>
                        <div>
                            <input type="date" name="date" required>
                        </div>
                        <div>
                            <input type="text" name="description" placeholder="Please complete the learning code with the time specification regarding the study time." required>
                        </div>
                        <div>
                            <input type="text" name="type" placeholder="Enter the schedule number of today" required>
                        </div>
                        <div>
                            <input type="submit" name="add" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>