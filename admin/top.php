<?php
require('../connection.php');
require('../function.php');
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!='')
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
    <title>Admin</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">
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
                        <span class="title">Admin</span>
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
                    <a href="teacher_menage.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Teachers</span>
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
                    <a href="category.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Courses</span>
                    </a>
                </li>
                <li>
                    <a href="password.php">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password Set</span>
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
                                if(isset($_SESSION['ADMIN_LOGIN']))
                                {
                                $email=$_SESSION['ADMIN_EMAIL'];
                                $res=mysqli_query($con,"SELECT * FROM `admin` WHERE email='$email'");
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

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <a href="teacher.php" style="text-decoration: none;">
                    <div class="card">
                        <div>
                        <?php
                                $res=mysqli_query($con,"select * from teacher order by id asc");
                                $teacher_cont=mysqli_num_rows($res);
                            ?>
                            <div class="numbers"><?php echo $teacher_cont ?></div>
                            <div class="cardName">Teachers List</div>
                        </div>
    
                        <div class="iconBx">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                    </div>
                    </a>
                <a href="students.php" style="text-decoration: none;">
                <div class="card">
                    <div>
                    <?php
                                $res=mysqli_query($con,"select * from enroll order by id asc");
                                $student_cont=mysqli_num_rows($res);
                            ?>
                        <div class="numbers"><?php echo $student_cont ?></div>
                        <div class="cardName">Students list</div>
                    </div>

                    <div class="iconBx">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>
                </a>
                <a href="course.php" style="text-decoration: none;">
                <div class="card">
                    <div>
                            <?php
                                $res=mysqli_query($con,"select * from course enroll order by id asc");
                                $course_cont=mysqli_num_rows($res);
                            ?>
                                    
                        <div class="numbers"><?php echo $course_cont ?></div>
                        <div class="cardName">Course list</div>
                    </div>

                    <div class="iconBx">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                </div>
                </a>
                
                <a href="playlist.php" style="text-decoration: none;">
                    <div class="card">
                        <?php
                        $playRes = mysqli_query($con, "SELECT * FROM `playlist`");
                        $count = mysqli_num_rows($playRes);
                        ?>
                        <div>
                            <div class="numbers"><?php echo $count ?></div>
                            <div class="cardName">Lessons Playlists</div>
                        </div>
                        <?php
                        ?>

                        <div class="iconBx">
                            <i class="fa-solid fa-play"></i>
                        </div>
                    </div>
                </a>
                <a href="filelist.php" style="text-decoration: none;">
                    <div class="card">
                        <?php
                        $playRes = mysqli_query($con, "SELECT * FROM `filelist`");
                        $count = mysqli_num_rows($playRes);
                        ?>
                        <div>
                            <div class="numbers"><?php echo $count ?></div>
                            <div class="cardName">Lessons Filelists</div>
                        </div>
                        <?php
                        ?>

                        <div class="iconBx">
                            <i class="fa-solid fa-play"></i>
                        </div>
                    </div>
                </a>
            </div>
