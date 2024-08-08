<?php
require('top.inc.php');
if(isset($_GET['id'])){
  $id=get_safe_value($con,$_GET['id']);
}
?>

<style>
    .learning{
    margin-top: 3rem;
    }
    <style>
  .details{
    display: grid;
    grid-template-columns:100%;
  }
  .playlist{
    width:100%;
    display:grid;
    grid-template-columns:40% 60%;
    gap:2rem;
    padding:2rem;
    border:1px solid gray;
  }
  .playlist img{
    width:100%;
  }
  .playlist h3{
    font-size:2rem;
  }
  .playlist p{
    font-size:1.5rem;
    text-align:justify;
  }
  .title{
    display:flex;
    flex-direction:column;
    gap:2rem;
  }
  .figure{
    position: relative;
  }
  .figure h3{
    position: absolute;
    bottom:1rem;
    right:1rem;
    background:#fff;
    border-radius:50%;
    padding:0.9rem 2rem;
  }
@media screen and (max-width:1024px) {
  .playlist{
    grid-template-columns:35% 60%;
    padding:1.5rem;
    border:1px solid gray;
  }
  .playlist h3{
    font-size:1.5rem;
  }
  .playlist p{
    font-size:1rem;
    text-align:justify;
  }
  .title{
    width:100%;
    display:flex;
    flex-direction:column;
    gap:1rem;
  }
  .figure h3{
    position: absolute;
    bottom:0.5rem;
    right:0.5rem;
    background:#fff;
    border-radius:50%;
    padding:0.5rem 1.5rem;
  }
}
@media screen and (max-width:600px) {
  .playlist{
    grid-template-columns:35% 55%;
    padding:0.5rem;
    border:1px solid gray;
  }
  .playlist h3{
    font-size:0.7rem;
  }
  .playlist p{
    font-size:0.5rem;
    text-align:justify;
  }
  .title{
    width:100%;
    display:flex;
    flex-direction:column;
    gap:0rem;
  }
  .figure h3{
    position: absolute;
    bottom:0.3rem;
    right:0.2rem;
    background:#fff;
    border-radius:50%;
    padding:0.2rem 0.7rem;
  }
}
   

    
</style>


  <section class="section learning" >
  <div class="container details">
  <h1>PlayList</h1>
  <?php
  $res = mysqli_query($con, "SELECT * FROM `playlist` where course='$id'");

  while ($row = mysqli_fetch_assoc($res)) {
      $playlistId = $row['id'];
      $videoRes = mysqli_query($con, "SELECT * FROM `video` WHERE playlist='$playlistId'");
      $count = mysqli_num_rows($videoRes);
  ?>

      <div class="playlist">
          <div class="figure">
              <a href="video_play_student/index.php?playlist=<?php echo $playlistId; ?>"><img src="playlist_img/<?php echo $row['image']; ?>" alt="">
                  <h3><?php echo $count; ?></h3>
              </a>
          </div>
          <div class="title">
              <h3><?php echo $row['name']; ?></h3>
              <p><?php echo $row['description']; ?></p>
          </div>
      </div>

  <?php
  } ?>
</div>
   

</section>









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