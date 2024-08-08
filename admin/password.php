<?php
require('top.inc.php');


$email='';
$password='';
$msg='';
if(isset($_POST['set'])){
    
    $email=get_safe_value($con,$_POST['email']);
    $password=get_safe_value($con,$_POST['password']);
  
    
     mysqli_query($con,"UPDATE `teacher` SET `password`='$password' WHERE email='$email'");
     require '../phpmailer/PHPMailerAutoload.php';

      $mail = new PHPMailer;

      //$mail->SMTPDebug = 3;                               // Enable verbose debug output

      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'aungnyinyimin32439@gmail.com';                 // SMTP username
      $mail->Password = 'gdbcegflheqtzjjd';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                                    // TCP port to connect to

      $mail->setFrom('aungnyinyimin32439@gmail.com', 'beauty life');
      $mail->addAddress($email);               // Name is optional

      $mail->addAttachment('./assets/images/lms-letter-technology-logo-design-white-background-lms-creative-initials-letter-logo-concept-lms-letter-design-lms-letter-252935662.jpg');         // Add attachments
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = 'Welcome form LMS';
      $mail->Body    = 'Welcome form LMS. Here you can <b>Create Your professional course</b> what you want.Have a nice day .<b> Your password is</b> ' .$password;

      if(!$mail->send()) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
          $msg='Email Send!';
      }
      $msg="Email send!";
    
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
                        <h2>SET PASSWORD</h2>
                    </div>
                    <form action="" method="post">
                        <div>
                            <input type="text" name="email" placeholder="Enter current email">
                        </div>
                        <div>
                            <input type="text" name="password" placeholder="Set password">
                        </div>
                        <div>
                            <input type="submit" name="set" value="SET">
                        </div>
                        <?php echo $msg ?>
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