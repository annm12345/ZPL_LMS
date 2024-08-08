<?php
require('../connection.php');
require('../function.php');
if(isset($_SESSION['TEACHER_LOGIN'])){
  if(isset($_GET['playlist'])){
    $playlist=get_safe_value($con,$_GET['playlist']);
  $email=$_SESSION['TEACHER_EMAIL'];
  $targetDir = '../video_play/media/';
  $title = $_POST['title'];
  $videoName = $_FILES['video']['name'];
  $videoNameWithoutExtension = pathinfo($videoName, PATHINFO_FILENAME);
  $videoID = 'vid_' . uniqid();
  

  // Move uploaded files to target directory
  $targetDir = '../video_play/media/';
  $videoPath = $targetDir . $videoName;
  
  $uploadOk = 1;
  $targetFile = $targetDir . basename($_FILES['video']['name']);


  // // Check if the file already exists
  // if (file_exists($targetFile)) {
  //   echo 'Error: File already exists.';
  //   $uploadOk = 0;
  // }

  // Check file size (maximum 100MB)
  if ($_FILES['video']['size'] > 10000000000) {
    echo 'Error: File is too large.';
    $uploadOk = 0;
  }


  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo 'Error: File was not uploaded.';
  } else {
    // Move the uploaded file to the target directory
      move_uploaded_file($_FILES['video']['tmp_name'], $videoPath);

      mysqli_query($con,"INSERT INTO `video`(`id`, `email`, `name`, `src`, `added_on`, `playlist`) VALUES ('$videoID','$email','$title','$videoNameWithoutExtension',NOW(),'$playlist')");

      // Display the upload time
      ?>
      <script>
        window.alert("Video uploaded successfully");
        window.location.href='index.php';
      </script>
      
      <?php
  
  }
}}
?>