<?php
require('../connection.php');
require('../function.php');
$result = array();

if (isset($_GET['student_id']) && isset($_GET['playlist'])) {
    $student_id = $_GET['student_id'];
    $playlist = $_GET['playlist'];
    
    $res = mysqli_query($con, "SELECT * FROM `last_watch` WHERE `playlist`='$playlist' AND `student_id`='$student_id'");
    
    if ($res) {
        // Check if there is a row fetched
        if (mysqli_num_rows($res) > 0) {
            // Fetch the row
            $row = mysqli_fetch_assoc($res);
            $result = $row;
        }
    } else {
        // Handle database query error
        $result['error'] = 'Database query error';
    }
}

echo json_encode($result);
?>
