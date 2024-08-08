<?php
require('top.inc.php');
if(isset($_GET['id']) && isset($_GET['action'])){
  $id=$_GET['id'];
  $action=$_GET['action'];
  if($action=='delete'){
    mysqli_query($con,"DELETE FROM `filelist` WHERE `id`='$id'");
  }
}
?>



<style>
    .details{
      display: grid;
      grid-template-columns:100%;
    }
    .playlist{
      width:100%;
      display:grid;
      grid-template-columns:20% 60% 5%;
      gap:2rem;
      padding:1rem;
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
    .playlist a{
      font-size:2rem;
      text-align:center;
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
      padding:0.9rem 1.5rem;
    }
  @media screen and (max-width:1024px) {
    .playlist{
      grid-template-columns:30% 55% 10%;
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
    .playlist a{
      font-size:2rem;
      text-align:center;
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
      padding:0.5rem 1rem;
    }
  }
  @media screen and (max-width:600px) {
    .playlist{
      grid-template-columns:20% 55% 10%;
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
    .playlist a{
      font-size:1rem;
      text-align:center;
    }
    .title{
      width:100%;
      display:flex;
      flex-direction:column;
      gap:0rem;
    }
    .figure h3{
      position: absolute;
      bottom:0.4rem;
      right:0.2rem;
      background:#fff;
      border-radius:50%;
      padding:0.2rem 0.4rem;
    }
  }
    
    
</style>

<div class="details">
  <h1>FileList</h1>
  <?php
  if(isset($_SESSION['TEACHER_LOGIN'])){
     
    $email=$_SESSION['TEACHER_EMAIL'];
  $res = mysqli_query($con, "SELECT * FROM `filelist` where email='$email'");

  while($row = mysqli_fetch_assoc($res)) {
      $filelist = $row['id'];
      $videoRes = mysqli_query($con, "SELECT * FROM `file` WHERE filelist='$filelist'");
      $count = mysqli_num_rows($videoRes);
    
  ?>

      <div class="playlist">
          <div class="figure">
              <a href="view_list.php?file=<?php echo $filelist; ?>"><img src="../media/image/<?php echo $row['image']; ?>" alt="">
                  <h3><?php echo $count; ?></h3>
              </a>
          </div>
          <div class="title">
              <h3><?php echo $row['name']; ?></h3>
              <p><?php echo $row['description']; ?></p>
          </div>
          <div style="margin-top:1rem;display:flex;align-items:center;">
            <a href="filelist.php?id=<?php echo $filelist ?>&action=delete" ><i class="fa-solid fa-trash" style="color:red;"></i></a>
          </div>
      </div>

  <?php
  } }
  ?>
</div>



    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>