
<?php
require('connection.php');
require('function.php');
$image='';
$name='';
$email='';
$birth='';
$address='';
$mobile='';
$password='';
$msg='';
            if(isset($_GET['id'])){
                $student_id=get_safe_value($con,$_GET['id']);
                $student_res=mysqli_query($con,"SELECT * FROM `student` where id='$student_id'");
                $student_row=mysqli_fetch_assoc($student_res);
                $email=$student_row['email'];
                if(isset($_GET['course_id'])){
                    $cat_id=get_safe_value($con,$_GET['course_id']);
                    $course_res=mysqli_query($con,"SELECT * FROM `category` where id='$cat_id'");
                    $course_row=mysqli_fetch_assoc($course_res);
                    $course=$course_row['category'];
if(isset($_POST['enroll'])){
    $action=0;
  date_default_timezone_set('Asia/Yangon');
  $added_on=date('Y-m-d');
  $res=mysqli_query($con,"select * from enroll where student_id='$student_id' and course_id='$cat_id'");
  $check=mysqli_num_rows($res);
  if($check>0){
    $msg="You have been already Enrolled";
  }else{

   mysqli_query($con,"INSERT INTO `enroll`(`student_id`, `course_id`, `action`, `added_on`) VALUES ('$student_id','$cat_id','$action','$added_on')");
    $msg="Your enroll is sucessfully completed";

    // require 'phpmailer/PHPMailerAutoload.php';

    //   $mail = new PHPMailer;

    //   //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    //   $mail->isSMTP();                                      // Set mailer to use SMTP
    //   $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    //   $mail->SMTPAuth = true;                               // Enable SMTP authentication
    //   $mail->Username = 'aungnyinyimin32439@gmail.com';                 // SMTP username
    //   $mail->Password = 'gdbcegflheqtzjjd';                           // SMTP password
    //   $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    //   $mail->Port = 587;                                    // TCP port to connect to

    //   $mail->setFrom('aungnyinyimin32439@gmail.com', 'beauty life');
    //   $mail->addAddress($email);               // Name is optional

    //   $mail->addAttachment('./assets/images/lms-letter-technology-logo-design-white-background-lms-creative-initials-letter-logo-concept-lms-letter-design-lms-letter-252935662.jpg');         // Add attachments
    //   $mail->isHTML(true);                                  // Set email format to HTML

    //   $mail->Subject = 'Welcome form LMS';
    //   $mail->Body    = 'Welcome form LMS. You had enrolled'.$course.' at ' . $added_on .'. <br> Your course feed is'.$course_row['feed'].'. <br> Please wait for comfirmation from course admin';

    //   if(!$mail->send()) {
    //       echo 'Message could not be sent.';
    //       echo 'Mailer Error: ' . $mail->ErrorInfo;
    //   } else {
    //       $msg='Email Send!';
    //   }
      ?>
      <script>
        window.location.href='index.php';
      </script>
      <?php
    }
}} }


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
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="admin/assets/css/login.css" />
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
            <?php
            if(isset($_GET['id'])){
                $student_id=get_safe_value($con,$_GET['id']);
                $student_res=mysqli_query($con,"SELECT * FROM `student` where id='$student_id'");
                $student_row=mysqli_fetch_assoc($student_res);
                if(isset($_GET['course_id'])){
                    $cat_id=get_safe_value($con,$_GET['course_id']);
                    $course_res=mysqli_query($con,"SELECT * FROM `category` where id='$cat_id'");
                    $course_row=mysqli_fetch_assoc($course_res);
                   
                }
            }
            ?>
            <h2 class="title">Enroll Course</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="" name="email" value="<?php echo $student_row['name']; ?>"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="text" placeholder="" name="password" value="<?php echo $course_row['category']; ?>"/>
            </div>
            
            <input type="submit" value="Enroll" name="enroll" class="btn solid" />
            <?php
            echo $msg;
            ?>
          </form>

        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Please Enroll Here!</h3>
            <p>
              You can enroll course what you want and wait form comfirmation email form Course admin!
            </p>
          </div>
          <img src="admin/assets/imgs/log.svg" class="image" alt="" />
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
    <script src="admin/assets/js/app.js"></script>
  </body>
</html>
