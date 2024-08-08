<?php
    require('../connection.php');
    require('../function.php');
    unset($_SESSION['TEACHER_LOGIN']);
    unset($_SESSION['TEACHER_EMAIL']);
    header('location:login.php');
    die();
?>

                  