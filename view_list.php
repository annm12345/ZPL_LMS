<?php
require('top.inc.php');
?>



<style>


.file-list {
    margin:auto;
    width:70%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.file-item {
    margin: 10px;
    text-align: center;
    padding:1.5rem;
}

.file-icon {
    width: 100px;
    height: 100px;
    object-fit: cover; /* Make the image cover the container */
}

.file-name {
    margin-top: 5px;
}

@media screen and (max-width: 600px) {
    .file-icon {
        width: 80px;
        height: 80px;
    }
}
</style>
      <?php
        if(isset($_GET['file'])){
          $file=$_GET['file'];
          
          $filelist_row=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `filelist` where id='$file' "));
          $filelist_name=$filelist_row['name'];
         
        }
      ?>
      <div style="text-align:center;margin-top:11rem;">
        <h2><?php echo $filelist_name ?></h2>
      </div>
<div class="details">
  
    <div class="file-list">
    <?php
      if(isset($_GET['file'])){
        $file=$_GET['file'];
        
       
        // SQL query to fetch files from the database
        $sql = "SELECT * FROM `file` where `filelist`='$file'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $file_name = $row['name'];
                $file_src = $row['src'];
                $file_ext = pathinfo($file_src, PATHINFO_EXTENSION);
              
                
                // Check file extension and display accordingly
                echo '<div class="file-item"> ';
                if($file_ext === 'pdf') {
                    echo '<a href="view_file.php?file=' . $file_src . '" target="_blank"><img src="media/image/PDF_file_icon.svg.png" alt="PDF Icon" style="width:100px;height:100px; object-fit: cover;"></a>';
                } elseif($file_ext === 'doc' || $file_ext === 'docx') {
                    echo '<a href="filelist/' . $file_src . '" target="_blank"><img src="media/image/Microsoft-Word-Logo.png" alt="Word Icon" style="width:100px;height:100px; object-fit: cover;"></a>';
                } else {
                    echo '<p>' . $file_name . '</p>';
                }
                echo '<p class="file-name">' . $file_name . '</p>';
                echo '</div>';
            }
        } else {
            echo 'No files found.';
        }
      }
      ?>

    </div>
</div>



    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>