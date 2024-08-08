<?php
require('../connection.php');
require('../function.php');

if(isset($_GET['video_id']) && isset($_GET['student_id']) && isset($_GET['playlist'])){
    $video_id=$_GET['video_id'];
    $student_id=$_GET['student_id'];
    $playlist=$_GET['playlist'];
    $res=mysqli_query($con,"SELECT * FROM `last_watch` WHERE `playlist`='$playlist' and `student_id`='$student_id'");
    $check=mysqli_num_rows($res);
    if($check>0){
        mysqli_query($con,"UPDATE `last_watch` SET `video_id`='$video_id' WHERE `playlist`='$playlist' and `student_id`='$student_id'");
    }else{
        mysqli_query($con,"INSERT INTO `last_watch`(`playlist`, `student_id`, `video_id`) VALUES ('$playlist','$student_id','$video_id')");
    }
    date_default_timezone_set('Asia/Yangon');
    $added_on=date('Y-m-d h:i:s');

    $finish_res = mysqli_query($con, "SELECT * FROM `finish_watch` WHERE `playlist`='$playlist' AND `student_id`='$student_id' AND `video_id`='$video_id'");
    $finish_check = mysqli_num_rows($finish_res);

    if($finish_check>0){
        
    }else{
        mysqli_query($con,"INSERT INTO `finish_watch`(`playlist`, `student_id`, `video_id`, `added_on`) VALUES ('$playlist','$student_id','$video_id','$added_on')");
    }
}


?>