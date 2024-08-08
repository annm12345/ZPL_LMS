<?php
require('top.inc.php');

$name='';
$email='';
$birth='';
$address='';
$mobile='';
$course='';
$duration='';
$password='';
$msg='';
if(isset($_GET['id'])){
    $id=get_safe_value($con,$_GET['id']);
    $check_res=mysqli_query($con,"SELECT * FROM `teacher` where id='$id'");
    $count=mysqli_num_rows($check_res);
    if($count>0){
        $check_row=mysqli_fetch_assoc($check_res);
        $name=$check_row['name'];
        $email=$check_row['email'];
        $birth=$check_row['birth'];
        $address=$check_row['address'];
        $mobile=$check_row['mobile'];
        $course=$check_row['course'];
        $duration=$check_row['duration'];
        $password=$check_row['password'];

    }
}

if(isset($_POST['update'])){
    $name=get_safe_value($con,$_POST['name']);
    $email=get_safe_value($con,$_POST['email']);
    $birth=get_safe_value($con,$_POST['birth']);
    $address=get_safe_value($con,$_POST['address']);
    $mobile=get_safe_value($con,$_POST['mobile']);
    $course=get_safe_value($con,$_POST['course']);
    $duration=get_safe_value($con,$_POST['duration']);
    $password=get_safe_value($con,$_POST['password']);
  
    
     mysqli_query($con,"UPDATE `teacher` SET `name`='$name',`email`='$email',`birth`='$birth',`mobile`='$mobile',`address`='$address',`course`='$course',`duration`='$duration',`password`='$password' WHERE id='$id'");
      
      ?>
      <script>
        window.alert('Sucessfully Updated ');
        window.location.href='teacher_menage.php';
      </script>
      
      <?php
    
  }

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
                            <input type="text" name="name" placeholder="Enter current name" required value="<?php echo $name ?>">
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="Enter current email" required value="<?php echo $email ?>">
                        </div>
                        <div>
                            <input type="date" name="birth" placeholder="Enter current birth date" required value="<?php echo $birth ?>">
                        </div>
                        <div>
                            <input type="mobile" name="mobile" placeholder="Enter current mobile" required value="<?php echo $mobile ?>">
                        </div>
                        <div>
                            <input type="address" name="address" placeholder="Enter current address" required value="<?php echo $address ?>">
                        </div> 
                        <div>
                            <input type="course" name="course" placeholder="Course Name" required value="<?php echo $course ?>">
                        </div> 
                        <div>
                            <input type="duration" name="duration" placeholder="Course Duration" required value="<?php echo $duration ?>">
                        </div> 
                        <div>
                            <input type="text" name="password" placeholder="Password" required value="<?php echo $password ?>">
                        </div>
                        <div>
                            <input type="submit" name="update" value="Update">
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