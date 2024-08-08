<?php
session_start();
$con=mysqli_connect("localhost","root","","zpl");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/php/ZPL_LMS/');
define('SITE_PATH','http://localhost/ZPL_lms/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/image/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/image/');
?>