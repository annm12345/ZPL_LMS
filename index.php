<?php
require('top.php');
if(isset($_SESSION['STUDENT_LOGIN']) && $_SESSION['STUDENT_LOGIN']!='')
{

}
else
{
    header('location:login.php');
    
}

?>


  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="section hero has-bg-image" id="home" aria-label="home"
        style="background-image: url('./assets/images/hero-bg.svg')">
        <div class="container">

          <div class="hero-content">

            <h1 class="h1 section-title">
              Higher Education Center <br><span class="span">Computer Science Department</span> 
            </h1>

            <p class="hero-text">
              Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit.
            </p>

            <a href="courses.php" class="btn has-before">
              <span class="span">Find courses</span>

              <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
            </a>

          </div>

          <figure class="hero-banner">

            <div class="img-holder one" style="--width: 270; --height: 300;">
              <img src=".//assets/images/hero-banner-1.jpg" width="270" height="300" alt="hero banner" class="img-cover">
            </div>

            <div class="img-holder two" style="--width: 240; --height: 370;">
              <img src="./assets/images/hero-banner-2.jpg" width="240" height="370" alt="hero banner" class="img-cover">
            </div>



            <img src="./assets/images/hero-shape-2.png" width="622" height="551" alt="" class="shape hero-shape-2">

          </figure>

        </div>
      </section>





      <!-- 
        - #CATEGORY
      

      <section class="section category" aria-label="category">
        <div class="container">

          <p class="section-subtitle">Categories</p>

          <h2 class="h2 section-title">
            Online <span class="span">Classes</span> For Remote Learning.
          </h2>

          <p class="section-text">
            Choose your Favourite course!
          </p>

          <ul class="grid-list">

            <li>
              <div class="category-card" style="--color: 170, 75%, 41%">

                <div class="card-icon">
                  <img src="./assets/images/category-1.svg" width="40" height="40" loading="lazy"
                    alt="Online Degree Programs" class="img">
                </div>

                <h3 class="h3">
                  <a href="courses.php" class="card-title">Online Degree Programs</a>
                </h3>

                <p class="card-text">
                  Lorem ipsum dolor consec tur elit adicing sed umod tempor.
                </p>

                <span class="card-badge">7 Courses</span>

              </div>
            </li>

            <li>
              <div class="category-card" style="--color: 351, 83%, 61%">

                <div class="card-icon">
                  <img src="./assets/images/category-2.svg" width="40" height="40" loading="lazy"
                    alt="Non-Degree Programs" class="img">
                </div>

                <h3 class="h3">
                  <a href="courses.html" class="card-title">Non-Degree Programs</a>
                </h3>

                <p class="card-text">
                  Lorem ipsum dolor consec tur elit adicing sed umod tempor.
                </p>

                <span class="card-badge">4 Courses</span>

              </div>
            </li>

            <li>
              <div class="category-card" style="--color: 229, 75%, 58%">

                <div class="card-icon">
                  <img src="./assets/images/category-3.svg" width="40" height="40" loading="lazy"
                    alt="Off-Campus Programs" class="img">
                </div>

                <h3 class="h3">
                  <a href="courses.html" class="card-title">Off-Campus Programs</a>
                </h3>

                <p class="card-text">
                  Lorem ipsum dolor consec tur elit adicing sed umod tempor.
                </p>

                <span class="card-badge">8 Courses</span>

              </div>
            </li>

            <li>
              <div class="category-card" style="--color: 42, 94%, 55%">

                <div class="card-icon">
                  <img src="./assets/images/category-4.svg" width="40" height="40" loading="lazy"
                    alt="Hybrid Distance Programs" class="img">
                </div>

                <h3 class="h3">
                  <a href="#" class="card-title">Hybrid Distance Programs</a>
                </h3>

                <p class="card-text">
                  Lorem ipsum dolor consec tur elit adicing sed umod tempor.
                </p>

                <span class="card-badge">8 Courses</span>

              </div>
            </li>

          </ul>

        </div>
      </section>
-->
    <section class="section category" aria-label="category">
        <div class="container">

          <p class="section-subtitle">Master's Degree Courses</p>

          <h2 class="h2 section-title">
          Department of Computer Science <br> <span class="span">Annual Master's Degree Courses</span>
          </h2>

          <p class="section-text">
            Choose your Favourite course!
          </p>

          <ul class="grid-list" >
            <?php 
            $res = mysqli_query($con, "SELECT * FROM `category` order by id asc");
            while($row=mysqli_fetch_assoc($res)){
              $id=$row['id'];
              $cateRes = mysqli_query($con, "SELECT * FROM `course` WHERE category='$id'");
              $count = mysqli_num_rows($cateRes);
            ?>

            <li>
              <div class="category-card" style="--color: 351, 83%, 61%">

                <h3 class="h3">
                  <a href="courses.php?id=<?php echo $row['id'] ?>" class="card-title"><?php echo $row['category'] ?></a>
                </h3>
                <span class="card-badge"><?php echo $count ?> Papers</span>

              </div>
            </li>
            <?php }
            ?>

          </ul>

        </div>
      </section>




      <!-- 
        - #ABOUT
      

      <section class="section about" id="about" aria-label="about">
        <div class="container">
          <a href="about.php">

          <figure class="about-banner">

            <div class="img-holder" style="--width: 520; --height: 370;">
              <img src="./assets/images/about-banner.jpg" width="520" height="370" loading="lazy" alt="about banner"
                class="img-cover">
            </div>

            <img src="./assets/images/about-shape-1.svg" width="360" height="420" loading="lazy" alt=""
              class="shape about-shape-1">

            <img src="./assets/images/about-shape-2.svg" width="371" height="220" loading="lazy" alt=""
              class="shape about-shape-2">

            <img src="./assets/images/about-shape-3.png" width="722" height="528" loading="lazy" alt=""
              class="shape about-shape-3">

          </figure>
          </a>
          <div class="about-content">

            <p class="section-subtitle">About Us</p>

            <h2 class="h2 section-title">
              Over 10 Years in <span class="span">Distant learning</span> for Skill Development
            </h2>

            <p class="section-text">
              Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna
              aliquaenim ad
              minim.
            </p>

            <ul class="about-list">

              <li class="about-item">
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>

                <span class="span">Expert Trainers</span>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>

                <span class="span">Online Remote Learning</span>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>

                <span class="span">Lifetime Access</span>
              </li>

            </ul>

            <img src="./assets/images/about-shape-4.svg" width="100" height="100" loading="lazy" alt=""
              class="shape about-shape-4">

          </div>

        </div>
      </section>
      -->




      <!-- 
        - #COURSE
      -->

      <!-- <section class="section course" id="courses" aria-label="course">
        <div class="container">

          <p class="section-subtitle">Popular Courses</p>

          <h2 class="h2 section-title">Pick A Course To Get Started</h2>

          <ul class="grid-list">
            <?php

                $res = mysqli_query($con, "SELECT * FROM `course` where popular=1 ");
                if(mysqli_num_rows($res)>0){
                while($row=mysqli_fetch_assoc($res)){
                  $id=$row['id'];
                $playRes = mysqli_query($con, "SELECT * FROM `playlist` WHERE course='$id'");
                $count = mysqli_num_rows($playRes);
                ?>
                <li>
                  <?php
                if(isset($_SESSION['STUDENT_LOGIN']) && $_SESSION['STUDENT_LOGIN']!=''){
                    $student_id=$_SESSION['STUDENT_ID'];
                    $enroll_res=mysqli_query($con,"SELECT * FROM `enroll` where student_id='$student_id' and course_id='$id' and action=1");
                    $check=mysqli_num_rows($enroll_res);
                    if($check>0){
                  
                
                ?>
                  <a href="learning.php?id=<?php echo $row['id'] ?>">
                  <div class="course-card">
    
                    <figure class="card-banner img-holder" style="--width: 370; --height: 220;">
                      <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" width="370" height="220" loading="lazy"
                        alt="Build Responsive Real- World Websites with HTML and CSS" class="img-cover">
                    </figure>
    
                    <div class="abs-badge">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
    
                      <span class="span"><?php echo $row['duration'] ?></span>
                    </div>
    
                    <div class="card-content">
    
                      <span class="badge"><?php echo $row['level'] ?></span>
    
                      <h3 class="h3">
                        <a href="learning.php?id=<?php echo $row['id'] ?>" class="card-title"><?php echo $row['name'] ?></a>
                      </h3>
    
                      <div class="wrapper">
    
                        <div class="rating-wrapper">
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                          <ion-icon name="star"></ion-icon>
                        </div>
    
                        <p class="rating-text">(5.0/7 Rating)</p>
    
                      </div>
    
                      <data class="price" value="29"><?php echo $row['feed'] ?></data>
    
                      <ul class="card-meta-list">
    
                        <li class="card-meta-item">
                          <ion-icon name="library-outline" aria-hidden="true"></ion-icon>
    
                          <span class="span"><?php echo $count ?> Lessons</span>
                        </li>
    
                        <li class="card-meta-item">
                          <ion-icon name="people-outline" aria-hidden="true"></ion-icon>
    
                          <span class="span"><?php echo '20' ?> Students</span>
                        </li>
    
                      </ul>
    
                    </div>
    
                  </div>
                  </a> 
                  <?php }else{
                    ?>
                   <a href="encroll.php?id=<?php echo $student_id ?>&course_id=<?php echo $id ?>">
                   <div class="course-card">
     
                     <figure class="card-banner img-holder" style="--width: 370; --height: 220;">
                       <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" width="370" height="220" loading="lazy"
                         alt="Build Responsive Real- World Websites with HTML and CSS" class="img-cover">
                     </figure>
     
                     <div class="abs-badge">
                       <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
     
                       <span class="span"><?php echo $row['duration'] ?></span>
                     </div>
     
                     <div class="card-content">
     
                       <span class="badge"><?php echo $row['level'] ?></span>
     
                       <h3 class="h3">
                         <a href="encroll.php?id=<?php echo $student_id ?>&course_id=<?php echo $id ?>" class="card-title"><?php echo $row['name'] ?></a>
                       </h3>
     
                       <div class="wrapper">
     
                         <div class="rating-wrapper">
                           <ion-icon name="star"></ion-icon>
                           <ion-icon name="star"></ion-icon>
                           <ion-icon name="star"></ion-icon>
                           <ion-icon name="star"></ion-icon>
                           <ion-icon name="star"></ion-icon>
                         </div>
     
                         <p class="rating-text">(5.0/7 Rating)</p>
     
                       </div>
     
                       <data class="price" value="29"><?php echo $row['feed'] ?></data>
     
                       <ul class="card-meta-list">
     
                         <li class="card-meta-item">
                           <ion-icon name="library-outline" aria-hidden="true"></ion-icon>
     
                           <span class="span"><?php echo $count ?> Lessons</span>
                         </li>
     
                         <li class="card-meta-item">
                           <ion-icon name="people-outline" aria-hidden="true"></ion-icon>
     
                           <span class="span"><?php echo '20' ?> Students</span>
                         </li>
     
                       </ul>
     
                     </div>
     
                   </div>
                   </a> 
                   <?php 
                  } }else{
                    ?>
                    <a href="login.php">
                   <div class="course-card">
     
                     <figure class="card-banner img-holder" style="--width: 370; --height: 220;">
                       <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" width="370" height="220" loading="lazy"
                         alt="Build Responsive Real- World Websites with HTML and CSS" class="img-cover">
                     </figure>
     
                     <div class="abs-badge">
                       <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
     
                       <span class="span"><?php echo $row['duration'] ?></span>
                     </div>
     
                     <div class="card-content">
     
                       <span class="badge"><?php echo $row['level'] ?></span>
     
                       <h3 class="h3">
                         <a href="login.php" class="card-title"><?php echo $row['name'] ?></a>
                       </h3>
     
                       <div class="wrapper">
     
                         <div class="rating-wrapper">
                           <ion-icon name="star"></ion-icon>
                           <ion-icon name="star"></ion-icon>
                           <ion-icon name="star"></ion-icon>
                           <ion-icon name="star"></ion-icon>
                           <ion-icon name="star"></ion-icon>
                         </div>
     
                         <p class="rating-text">(5.0/7 Rating)</p>
     
                       </div>
     
                       <data class="price" value="29"><?php echo $row['feed'] ?></data>
     
                       <ul class="card-meta-list">
     
                         <li class="card-meta-item">
                           <ion-icon name="library-outline" aria-hidden="true"></ion-icon>
     
                           <span class="span"><?php echo $count ?> Lessons</span>
                         </li>
     
                         <li class="card-meta-item">
                           <ion-icon name="people-outline" aria-hidden="true"></ion-icon>
     
                           <span class="span"><?php echo '20' ?> Students</span>
                         </li>
     
                       </ul>
     
                     </div>
     
                   </div>
                   </a> 
                    <?php
                  }
                  ?>
                </li>
                <?php
            } } else{
              echo "No popular course";
            }
            ?>
          </ul>

          <a href="courses.php" class="btn has-before">
            <span class="span">Browse more courses</span>

            <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
          </a>

        </div>
      </section> -->





      <!-- 
        - #VIDEO
      

      <section class="video has-bg-image" aria-label="video"
        style="background-image: url('./assets/images/video-bg.png')">
        <div class="container">
          <a href="playlist.php">

          <div class="video-card">

            <div class="video-banner img-holder has-after" style="--width: ; --height: ;">
              <img src="./assets/images/video-banner.jpg" width="970" height="550" loading="lazy" alt="video banner"
                class="img-cover">

              <button class="play-btn" aria-label="play video">
                <ion-icon name="play" aria-hidden="true"></ion-icon>
              </button>
            </div>

            <img src="./assets/images/video-shape-1.png" width="1089" height="605" loading="lazy" alt=""
              class="shape video-shape-1">

            <img src="./assets/images/video-shape-2.png" width="158" height="174" loading="lazy" alt=""
              class="shape video-shape-2">

          </div>
        </a>

        </div>
      </section>
      -->




      <!-- 
        - #STATE
      

      <section class="section stats" aria-label="stats">
        <div class="container">

          <ul class="grid-list">

            <li>
              <?php
                  $res=mysqli_query($con,"select * from enroll ");
                  $enroll_count=mysqli_num_rows($res);
              ?>
              <div class="stats-card" style="--color: 170, 75%, 41%">
                <h3 class="card-title"><?php echo $enroll_count ?></h3>

                <p class="card-text">Student Enrolled</p>
              </div>
            </li>

            <li>
              <div class="stats-card" style="--color: 351, 83%, 61%">
                <h3 class="card-title">0</h3>

                <p class="card-text">Class Completed</p>
              </div>
            </li>

            <li>
              <div class="stats-card" style="--color: 260, 100%, 67%">
                <h3 class="card-title">100%</h3>

                <p class="card-text">Satisfaction Rate</p>
              </div>
            </li>

            <li>
              <div class="stats-card" style="--color: 42, 94%, 55%">
                <h3 class="card-title">99+</h3>

                <p class="card-text">Top Instructors</p>
              </div>
            </li>

          </ul>

        </div>
      </section>

      -->



      <!-- 
        - #BLOG
      

      <section class="section blog has-bg-image" id="blog" aria-label="blog"
        style="background-image: url('./assets/images/blog-bg.svg')">
        <div class="container">

          <p class="section-subtitle">Latest Articles</p>

          <h2 class="h2 section-title">Get News With Eduweb</h2>

          <ul class="grid-list">

            <li>
              <div class="blog-card">

                <figure class="card-banner img-holder has-after" style="--width: 370; --height: 370;">
                  <img src="./assets/images/blog-1.jpg" width="370" height="370" loading="lazy"
                    alt="Become A Better Blogger: Content Planning" class="img-cover">
                </figure>

                <div class="card-content">

                  <a href="blog.php" class="card-btn" aria-label="read more">
                    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                  </a>

                  <a href="blog.php" class="card-subtitle">Online</a>

                  <h3 class="h3">
                    <a href="blog.php" class="card-title">Become A Better Blogger: Content Planning</a>
                  </h3>

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="calendar-outline" aria-hidden="true"></ion-icon>

                      <span class="span">Oct 10, 2021</span>
                    </li>

                    <li class="card-meta-item">
                      <ion-icon name="chatbubbles-outline" aria-hidden="true"></ion-icon>

                      <span class="span">Com 09</span>
                    </li>

                  </ul>

                  <p class="card-text">
                    Lorem Ipsum Dolor Sit Amet Cons Tetur Adipisicing Sed.
                  </p>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card">

                <figure class="card-banner img-holder has-after" style="--width: 370; --height: 370;">
                  <img src="./assets/images/blog-2.jpg" width="370" height="370" loading="lazy"
                    alt="Become A Better Blogger: Content Planning" class="img-cover">
                </figure>

                <div class="card-content">

                  <a href="#" class="card-btn" aria-label="read more">
                    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                  </a>

                  <a href="#" class="card-subtitle">Online</a>

                  <h3 class="h3">
                    <a href="#" class="card-title">Become A Better Blogger: Content Planning</a>
                  </h3>

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="calendar-outline" aria-hidden="true"></ion-icon>

                      <span class="span">Oct 10, 2021</span>
                    </li>

                    <li class="card-meta-item">
                      <ion-icon name="chatbubbles-outline" aria-hidden="true"></ion-icon>

                      <span class="span">Com 09</span>
                    </li>

                  </ul>

                  <p class="card-text">
                    Lorem Ipsum Dolor Sit Amet Cons Tetur Adipisicing Sed.
                  </p>

                </div>

              </div>
            </li>

            <li>
              <div class="blog-card">

                <figure class="card-banner img-holder has-after" style="--width: 370; --height: 370;">
                  <img src="./assets/images/blog-3.jpg" width="370" height="370" loading="lazy"
                    alt="Become A Better Blogger: Content Planning" class="img-cover">
                </figure>

                <div class="card-content">

                  <a href="#" class="card-btn" aria-label="read more">
                    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                  </a>

                  <a href="#" class="card-subtitle">Online</a>

                  <h3 class="h3">
                    <a href="#" class="card-title">Become A Better Blogger: Content Planning</a>
                  </h3>

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="calendar-outline" aria-hidden="true"></ion-icon>

                      <span class="span">Oct 10, 2021</span>
                    </li>

                    <li class="card-meta-item">
                      <ion-icon name="chatbubbles-outline" aria-hidden="true"></ion-icon>

                      <span class="span">Com 09</span>
                    </li>

                  </ul>

                  <p class="card-text">
                    Lorem Ipsum Dolor Sit Amet Cons Tetur Adipisicing Sed.
                  </p>

                </div>

              </div>
            </li>

          </ul>

          <img src="./assets/images/blog-shape.png" width="186" height="186" loading="lazy" alt=""
            class="shape blog-shape">

        </div>
      </section>
      -->

    </article>
  </main>





  <?php
  require('foot.php');
  ?>