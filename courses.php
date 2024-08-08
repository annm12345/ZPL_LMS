<?php
require('top.inc.php');
if(isset($_GET['id'])){
  $id=get_safe_value($con,$_GET['id']);
}
?>




  <main>
   <!-- 
        - #COURSE
      -->

      <section class="section course" id="courses" aria-label="course">
        <div class="container">

          <p class="section-subtitle">Popular Courses</p>

          <h2 class="h2 section-title">Pick A Course To Get Started</h2>

          <ul class="grid-list">

          <?php 
          if(isset($_GET['id'])){
            $cat_id=get_safe_value($con,$_GET['id']);
          
          $res = mysqli_query($con, "SELECT * FROM `course` where category='$cat_id'");
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
                    $enroll_res=mysqli_query($con,"SELECT * FROM `enroll` where student_id='$student_id' and course_id='$cat_id' and action=1");
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
    
                      <h3 class="h3">
                        <a href="learning.php?id=<?php echo $row['id'] ?>" class="card-title"><?php echo $row['name'] ?></a>
                      </h3>
    
                      
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
                   <a href="encroll.php?id=<?php echo $student_id ?>&course_id=<?php echo $cat_id ?>">
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

                       <h3 class="h3">
                         <a href="encroll.php?id=<?php echo $student_id ?>&course_id=<?php echo $cat_id ?>" class="card-title"><?php echo $row['name'] ?></a>
                       </h3>
     
                       
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
     
                       <h3 class="h3">
                         <a href="login.php" class="card-title"><?php echo $row['name'] ?></a>
                       </h3>
     
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
            <?php } } }else{
              
              $res = mysqli_query($con, "SELECT * FROM `course` order by id asc ");
              while($row=mysqli_fetch_assoc($res)){
                $id=$row['id'];
                $cat_id=$row['category'];
                $playRes = mysqli_query($con, "SELECT * FROM `playlist` WHERE course='$id'");
                $count = mysqli_num_rows($playRes);
                ?>
                <li>
                <?php
                if(isset($_SESSION['STUDENT_LOGIN']) && $_SESSION['STUDENT_LOGIN']!=''){
                    $student_id=$_SESSION['STUDENT_ID'];
                    $enroll_res=mysqli_query($con,"SELECT * FROM `enroll` where student_id='$student_id' and course_id='$cat_id' and action=1");
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
    
               
    
                      <h3 class="h3">
                        <a href="learning.php?id=<?php echo $row['id'] ?>" class="card-title"><?php echo $row['name'] ?></a>
                      </h3>
    
                      
    
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
                   <a href="encroll.php?id=<?php echo $student_id ?>&course_id=<?php echo $cat_id ?>">
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
     
                       
     
                       <h3 class="h3">
                         <a href="encroll.php?id=<?php echo $student_id ?>&course_id=<?php echo $cat_id ?>" class="card-title"><?php echo $row['name'] ?></a>
                       </h3>
     
                       
     
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
     
                      
     
                       <h3 class="h3">
                         <a href="login.php" class="card-title"><?php echo $row['name'] ?></a>
                       </h3>
     
                       
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
            } }
            ?>
          </ul>

       

        </div>
      </section>










      <!-- 
        - #STATE
      -->

      <!-- <section class="section stats" aria-label="stats">
        <div class="container">

          <ul class="grid-list">

            <li>
              <div class="stats-card" style="--color: 170, 75%, 41%">
                <h3 class="card-title">29.3k</h3>

                <p class="card-text">Student Enrolled</p>
              </div>
            </li>

            <li>
              <div class="stats-card" style="--color: 351, 83%, 61%">
                <h3 class="card-title">32.4K</h3>

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
                <h3 class="card-title">354+</h3>

                <p class="card-text">Top Instructors</p>
              </div>
            </li>

          </ul>

        </div>
      </section> -->






    </article>
  </main>




<?php
require('foot.php');
?>