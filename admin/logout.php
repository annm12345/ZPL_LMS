<?php
    require('../connection.php');
    require('../function.php');
    unset($_SESSION['ADMIN_LOGIN']);
    unset($_SESSION['ADMIN_EMAIL']);
    header('location:login.php');
    die();
?>

                  