<?php
require('../connection.php');
require('../function.php');
if(isset($_SESSION['TEACHER_LOGIN']) && $_SESSION['TEACHER_LOGIN']!='')
{

}
else
{
    header('location:login.php');
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Admin</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simple-ajax-uploader/2.6.7/SimpleAjaxUploader.min.js" integrity="sha512-sF1OQUX4620btxfaKLxsFeu/euV3FcPyH+uST3mdEjc8vW8R4z1xNiZhcG7wcZQbFkgFhiiBoAyYNMCL3jufPA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="index.php">
                        <span class="icon">
                            <img src="../assets/images/lms-letter-technology-logo-design-white-background-lms-creative-initials-letter-logo-concept-lms-letter-design-lms-letter-252935662.jpg" width="50" height="50" alt="Learning Management System" style="border-radius: 50%;">
                        </span>
                        <span class="title">Teacher Admin</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="students_menage.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Students</span>
                    </a>
                </li>
                <li>
                    <a href="course.php">
                        <span class="icon">
                        <i class="fa-solid fa-chalkboard-user" style="font-size:1.6rem;"></i>
                        </span>
                        <span class="title">Papers</span>
                    </a>
                </li>
                <li>
                    <a href="course_create.php">
                        <span class="icon">
                        <i class="fa-solid fa-square-plus" style="font-size:1.6rem;"></i>
                        </span>
                        <span class="title">Paper Create</span>
                    </a>
                </li>
                <li>
                    <a href="Schedule.php">
                        <span class="icon">
                            <i class="fa-solid fa-calendar-plus" style="font-size: 1.5rem;"></i>
                        </span>
                        <span class="title">Add Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="playlist.php">
                        <span class="icon">
                        <i class="fa-solid fa-file-video" style="font-size:1.6rem;"></i>
                        </span>
                        <span class="title">Lesson playlist</span>
                    </a>
                </li>
                <li>
                    <a href="filelist.php">
                        <span class="icon">
                        <i class="fa-regular fa-file-zipper" style="font-size:1.6rem;"></i>
                        </span>
                        <span class="title">Lesson Filelist</span>
                    </a>
                </li>
                <li>
                    <a href="exam_list.php">
                        <span class="icon">
                        <i class="fa-solid fa-check-to-slot" style="font-size:1.6rem;"></i>
                        </span>
                        <span class="title">Exam List</span>
                    </a>
                </li>
                <li>
                    <a href="playlist_create.php">
                        <span class="icon">
                            <i class="fa-solid fa-upload" style="font-size: 1.5rem;"></i>
                        </span>
                        <span class="title">Video upload</span>
                    </a>
                </li>
                <li>
                    <a href="filelist_create.php">
                        <span class="icon">
                        <i class="fa-solid fa-file-lines" style="font-size: 1.5rem;"></i>
                        </span>
                        <span class="title">Lesson File upload</span>
                    </a>
                </li>
                <li>
                    <a href="profile.php">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Profile setting</span>
                    </a>
                </li>

                <li>
                    <a href="logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <?php
                                if(isset($_SESSION['TEACHER_LOGIN']))
                                {
                                $email=$_SESSION['TEACHER_EMAIL'];
                                $res=mysqli_query($con,"SELECT * FROM `teacher` WHERE email='$email'");
                                $check=mysqli_num_rows($res);
                                if($check>0){
                                    $row=mysqli_fetch_assoc($res);
                                    ?>
                                    <?php echo $row['name'] ?>
                                        <div class="user">
                                            
                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" alt="">
                                        </div>
                                        <?php 
                                    }} ?>
            </div>
