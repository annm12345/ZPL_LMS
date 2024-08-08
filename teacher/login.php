
<?php
require('../connection.php');
require('../function.php');
$image='';
$name='';
$email='';
$birth='';
$address='';
$mobile='';
$course='';
$duration='';
$password='';
$msg='';
if(isset($_POST['signup'])){
  $image = $_FILES['image']['name'];
  $image_temp_name = $_FILES['image']['tmp_name'];
  move_uploaded_file($image_temp_name,'../media/image/'.$image);
  $name=get_safe_value($con,$_POST['name']);
  $email=get_safe_value($con,$_POST['email']);
  $birth=get_safe_value($con,$_POST['birth']);
  $address=get_safe_value($con,$_POST['address']);
  $mobile=get_safe_value($con,$_POST['mobile']);
  $course=get_safe_value($con,$_POST['course']);
  $duration=get_safe_value($con,$_POST['duration']);
  date_default_timezone_set('Asia/Yangon');
  $added_on=date('Y-m-d h:i:s');

  $res=mysqli_query($con,"SELECT * FROM `teacher` where `email`='$email'");
  $check=mysqli_num_rows($res);
  if($check>0){
    $msg="Your email already exist";
  }else{
   mysqli_query($con,"INSERT INTO `teacher`(`name`, `email`, `birth`, `mobile`, `address`, `course`, `duration`, `image`, `added_on`) VALUES ('$name','$email','$birth','$mobile','$address','$course','$duration','$image','$added_on')");
    $msg="Your signup is sucessfully completed </br>
    The admin will notify you back. For details, please contact 09123456789.";
  }
}
if(isset($_POST['signin'])){
    $email=get_safe_value($con,$_POST['email']);
    $password=get_safe_value($con,$_POST['password']);
    if(empty(get_safe_value($con,$_POST['email'])))
    {
        $msg="Please enter user email";
    }
    else if(empty(get_safe_value($con,$_POST['password'])))
    {
        $msg="Please enter user password";
    }
    else 
    {
        $res=mysqli_query($con,"select * from teacher where email='$email' and password='$password'");
        $row=mysqli_fetch_assoc($res);
        $count=mysqli_num_rows($res);
        if($count>0)
        { 
            $row=mysqli_fetch_assoc($res);
            $_SESSION['TEACHER_LOGIN']='yes';
            $_SESSION['TEACHER_EMAIL']=$email;
            ?>
            <script>
            window.location.href='index.php';
            </script>
        <?php }
        else 
        {
            $msg="Please enter login correct detail";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="assets/css/login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">
    <title>Sign in & Sign up Form</title>
    <style>
      .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
      }

      .input-file {
        display: none;
        align-items: center;
        justify-content: center;
      }

      .file-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      .file-label:hover {
        background-color: #0056b3;
      }

      .file-label span {
        margin-right: 8px;
      }

      .file-label svg {
        fill: currentColor;
        width: 20px;
        height: 20px;
      }

    </style>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" class="sign-in-form" method="post">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" placeholder="Email" name="email" required value="<?php echo $email ?>"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required value="<?php echo $password ?>"/>
            </div>
            <input type="submit" value="Login" name="signin" class="btn solid" />
            <?php
            echo $msg;
            ?>
          </form>


<!-----------==================Sign Up=============================---------------------->

          <form action="" class="sign-up-form" method="post" enctype="multipart/form-data">>
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fa-solid fa-file-import"></i>
              <input type="file" id="file-input" class="input-file" name="image" onchange="displayFileName()" required value="<?php echo $image ?>">
              <label for="file-input" class="file-label">
                <span>Choose a file</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path d="M0 0h24v24H0z" fill="none" />
                  <path d="M12 2L2 12h3v8h14v-8h3L12 2zm4 14h-2v-2h2v2zm0-4h-2V7h2v5z" />
                </svg>
              </label>
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="name" required value="<?php echo $name ?>"/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required value="<?php echo $email ?>"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="date" placeholder="Birth of Date" name="birth" required value="<?php echo $birth ?>"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="address" placeholder="Address" name="address" required value="<?php echo $address ?>"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="mobile" placeholder="Mobile" name="mobile" required value="<?php echo $mobile ?>"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="text" placeholder="Course name" name="course" required value="<?php echo $course ?>"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="text" placeholder="Course duration" name="duration" required value="<?php echo $duration ?>"/>
            </div>
            <input type="submit" class="btn" value="Sign up" name="signup" />
            <?php
            echo $msg;
            ?>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
              ex ratione. Aliquid!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="assets/imgs/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="assets/imgs/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>
      <script>
        function displayFileName() {
        const fileInput = document.getElementById('file-input');
        const fileName = fileInput.value.split('\\').pop(); // Extract the file name from the file path
        const spanElement = document.querySelector('.file-label span');
        spanElement.textContent = fileName;
        }

      </script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
