<?php
require('connection.php');
require('function.php');
if(isset($_SESSION['STUDENT_LOGIN']))
{

}else
{
   
  ?>
  <script>
    window.location.href='login.php';
  </script>
  
  <?php
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 
    - primary meta tag
  -->
  <title>Learning Management System</title>
  <meta name="title" content="Learning Management System">
  <meta name="description" content="This is learnin website">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="assets/css/learning.css">
  <link rel="stylesheet" href="assets/css/list.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./assets/images/hero-bg.svg">
  <link rel="preload" as="image" href="./assets/images/hero-banner-1.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-banner-2.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-shape-1.svg">
  <link rel="preload" as="image" href="./assets/images/hero-shape-2.png">

</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <a href="#" class="logo">
        <img src="./assets/images/lms-letter-technology-logo-design-white-background-lms-creative-initials-letter-logo-concept-lms-letter-design-lms-letter-252935662.jpg" width="75" height="50" alt="Learning Management System">
      </a>

      <nav class="navbar" data-navbar>

        <div class="wrapper">
          <a href="#" class="logo">
            <img src="./assets/images/lms-letter-technology-logo-design-white-background-lms-creative-initials-letter-logo-concept-lms-letter-design-lms-letter-252935662.jpg" width="75" height="50" alt="Learning Management System">
          </a>

          <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
            <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
          </button>
        </div>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="index.php" class="navbar-link" data-nav-link>Home</a>
          </li>

          <li class="navbar-item">
            <a href="about.php" class="navbar-link" data-nav-link>About</a>
          </li>

          <li class="navbar-item">
            <a href="courses.php" class="navbar-link" data-nav-link>Courses</a>
          </li>

          <!-- <li class="navbar-item">
            <a href="blog.php" class="navbar-link" data-nav-link>Blog</a>
          </li> -->

          <li class="navbar-item">
            <a href="contact.php" class="navbar-link" data-nav-link>Contact</a>
          </li>
        <?php
            if(isset($_SESSION['STUDENT_LOGIN']) && $_SESSION['STUDENT_LOGIN']!='')
            { 
                ?>
                <li class="navbar-item">
                    <a href="logout.php" class="navbar-link" data-nav-link>Logout</a>
                </li>
                <?php
            }else{
                ?>
                <li class="navbar-item">
                    <a href="logout.php" class="navbar-link" data-nav-link>Sign in</a>
                </li>
                <?php
            }
            ?>
        </ul>

      </nav>

      <div class="header-actions">

        <?php
          if(isset($_SESSION['STUDENT_LOGIN']) && $_SESSION['STUDENT_LOGIN']!='')
        {
          $id=$_SESSION['STUDENT_ID'];
          $res=mysqli_query($con,"select * from student where id='$id'");
          $row=mysqli_fetch_assoc($res);
          $enroll_res=mysqli_query($con,"select * from enroll where student_id='$id' and action=0");
          $count=mysqli_num_rows($enroll_res);
          ?>
        <button class="header-action-btn" aria-label="cart" title="Cart">
          <a href="result.php?id=<?php echo $id ?>">
          <ion-icon name="checkmark-circle-outline" aria-hidden="true"></ion-icon>
          </a>
         
          
          
        </button>
        <button class="header-action-btn" aria-label="cart" title="Cart">
          <a href="enroll_list.php?id=<?php echo $id ?>">
          <ion-icon name="cart-outline" aria-hidden="true"></ion-icon>
          </a>
         
          <span class="btn-badge"><a href="enroll_list.php?id=<?php echo $id ?>"><?php echo $count ?></a></span>
          
          
        </button>
        <?php }
          ?>
        <?php
        if(isset($_SESSION['STUDENT_LOGIN']) && $_SESSION['STUDENT_LOGIN']!='')
        {
          $id=$_SESSION['STUDENT_ID'];
          $res=mysqli_query($con,"select * from student where id='$id'");
          $row=mysqli_fetch_assoc($res);
          ?>

          <span class="span"><?php echo $row['name'] ?></span>
           <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" style="width:50px;height:50px;border-radius:50%;">
           <a href="logout.php" class="btn has-before" data-nav-link>
              <span class="span">Logout</span>
            </a>
            <?php
          
        }else{
          ?>
        <a href="login.php" class="btn has-before" >
          <span class="span">Try for free</span>

          <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
        </a>
        <?php
      }
        ?>

        

        <button class="header-action-btn" aria-label="open menu" data-nav-toggler>
          <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
        </button>

      </div>

      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>


