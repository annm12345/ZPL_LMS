<?php
require('top.inc.php');
if(isset($_GET['id'])){
  $id=get_safe_value($con,$_GET['id']);
  $res=mysqli_query($con,"select * from course where id='$id'");
  $row=mysqli_fetch_assoc($res);
  $email=$row['email'];
  $teacher_res=mysqli_query($con,"SELECT * FROM `teacher` where email='$email'");
  $teacher_row=mysqli_fetch_assoc($teacher_res);
}
?>




  <main>
   <article>

    <section class="section learning">
        <div class="container learning-container">
            <div class="learning-left">
                <figure class="card-banner img-holder" style="--width: 370; --height: 220;">
                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" width="370" height="220" loading="lazy"
                      alt="Build Responsive Real- World Websites with HTML and CSS" class="img-cover">
                </figure>
                <p><?php echo $teacher_row['name'] ?></p>
            </div>
            <div class="learning-right">
                <h1>
                    <?php echo $row['name'] ?>
                </h1>
                <div class="learning-cards">
                <article class="learning-card">
                  <a href="playlist.php?id=<?php echo $id ?>">
                    <div class="span-icon">
                        <i class="fa-solid fa-play"></i>
                        
                    </div>
                    <h3>Lessons Videos</h3>
                  </a>
                </article>
                <article class="learning-card">
                  <a href="filelist.php?id=<?php echo $id ?>">
                    <div class="span-icon">
                        <i class="fa-regular fa-file-zipper"></i>
                        
                    </div>
                    <h3>Lessons Files</h3>
                  </a>
                </article>
                <article class="learning-card">
                  <a href="video_room/lobby.html">
                    <div class="span-icon">
                        <i class="fa-solid fa-video"></i>
                        
                    </div>
                    <h3>Learning Room</h3>
                  </a>
                </article>
                <article class="learning-card">
                  <a href="examlist.php?id=<?php echo $row['id'] ?>">
                    <div class="span-icon">
                        <i class="fa-solid fa-check-to-slot"></i>
                        
                    </div>
                    <h3>Exam List</h3>
                  </a>
                </article>
                <article class="learning-card">
                  <a href="calendar.php?id=<?php echo $row['id'] ?>">
                    <div class="span-icon">
                        <i class="fa-solid fa-calendar"></i>
                        
                    </div>
                    <h3>Learning Schedule</h3>
                  </a>
                </article>
                </div>
            </div>
        </div>

    </section>
<!-- 
    <section class="section students">
      <h2 >MEET OUR STUDENTS</h2>
      <div class="container team_container">
      <?php
              if(isset($_GET['id'])){
                  $id=get_safe_value($con,$_GET['id']);
                  $res=mysqli_query($con,"select * from enroll where course_id='$id'");
                  $row=mysqli_fetch_assoc($res);
                  $student_id=$row['student_id']; 
                  $student_res=mysqli_query($con,"select * from `student` where `id`='$student_id' ");
                  $student_row=mysqli_fetch_assoc($student_res);
                  $course_res=mysqli_query($con,"select * from course where id='$id'");
                  $course_row=mysqli_fetch_assoc($course_res);
                  $birthdate=$student_row['birth'];
                  $today=date('Y-m-d');
                  $diff = date_diff(date_create($birthdate), date_create($today));
                  $age = $diff->format('%y');
                  ?>
          <article class="team_member">
            <?php
             
            ?>
              <div class="team_member_image">
                  <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$student_row['image'] ?>" alt="">
              </div>
              <div class="team_member_info">
                  <h4><?php echo $student_row['name'] ?></h4>
                  <P><?php echo $age ?></P>
              </div>
              <div class="team_member_socials">
                  <h4><?php echo $course_row['level'] ?></h4>
              </div>
          </article>
          <?php } ?>
      </div>
    </section>
  ------TEAM END------------>
    
    <!-- 
        - #STATE
    

      <section class="section stats" aria-label="stats">
        <div class="container">

          <ul class="grid-list">

            <li>
              <div class="stats-card" style="--color: 170, 75%, 41%">
              <?php
              if(isset($_GET['id'])){
                  $id=get_safe_value($con,$_GET['id']);
                  $res=mysqli_query($con,"select * from enroll where course_id='$id'");
                  $enroll_count=mysqli_num_rows($res);
                  ?>
                <h3 class="card-title"><?php echo $enroll_count ?></h3>
                <?php }
                ?>

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
      </section> -->





    </article>
  </main>









  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>