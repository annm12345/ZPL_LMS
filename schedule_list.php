<?php
require('connection.php');
require('function.php');
if(isset($_GET['id'])){
    $id=get_safe_value($con,$_GET['id']);
    $file=array();
$res=mysqli_query($con,"SELECT `schedule`.*,`course`.`name` from `schedule`,`course` where `schedule`.`name`='$id' and `course`.`id`='$id'");
while($row=mysqli_fetch_assoc($res)){
  $file[]=$row;
}
}

echo json_encode($file);
?>