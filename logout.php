<?php
    require('connection.php');
    require('function.php');
    unset($_SESSION['STUDENT_LOGIN']);
    unset($_SESSION['STUDENT_EMAIL']);
    unset($_SESSION['STUDENT_ID']);
    header('location:login.php');
    die();
?>

                  