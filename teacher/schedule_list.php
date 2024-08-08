<?php
require('../connection.php');
require('../function.php');
if(isset($_SESSION['TEACHER_LOGIN'])){
    $email=$_SESSION['TEACHER_EMAIL'];
$file=array();
$res=mysqli_query($con,"SELECT `schedule`.*,`course`.`name` from `schedule`,`course` where `schedule`.`name`=`course`.`id` and `schedule`.`email`='$email'");
while($row=mysqli_fetch_assoc($res)){
  $file[]=$row;
}
}

echo json_encode($file);
?>