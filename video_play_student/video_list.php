<?php
require('../connection.php');
require('../function.php');
if(isset($_GET['playlist'])){

$playlist=get_safe_value($con,$_GET['playlist']);
    $file = array();
    $res = mysqli_query($con, "SELECT `name`, `src`, `id` FROM `video` where playlist='$playlist'");
    while ($row = mysqli_fetch_assoc($res)) {
        $file[] = $row;
    }
}


    echo json_encode($file);

?>
