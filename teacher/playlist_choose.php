<?php
require('top.inc.php');
$image='';
$name='';
$description='';

$msg='';
if(isset($_SESSION['TEACHER_LOGIN'])){
    $email=$_SESSION['TEACHER_EMAIL'];
    if(isset($_POST['create'])){
        $image = $_FILES['image']['name'];
        $image_temp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_temp_name,'../playlist_img/'.$image);
        $name=get_safe_value($con,$_POST['name']);
        $description=get_safe_value($con,$_POST['description']);
        $course=get_safe_value($con,$_POST['course']);
        date_default_timezone_set('Asia/Yangon');
        $added_on=date('Y-m-d h:i:s');
      
        
         mysqli_query($con,"INSERT INTO `playlist`(`email`,`course`,`name`, `image`, `description`, `added_on`) VALUES ('$email','$course','$name','$image','$description','$added_on')");
          
          ?>
          <script>
            window.alert('Sucessfully Create ');
            window.location.href='playlist_choose.php';
          </script>
          
          <?php
        
      }
      if(isset($_POST['go'])){
            $name=get_safe_value($con,$_POST['name']);
          ?>
          <script>
            window.location.href='upload.php?playlistname=<?php echo $name ?>';
          </script>
          
          <?php
        
      }
}
?>

<!-- ================ Order Details List ================= -->
<style>
                .details{
                    display: grid;
                    grid-template-columns: 1fr;
                }
                a{
                    text-decoration: none;
                }
                form{
                    margin-top: 3rem;
                    width: 100%;
                    display: flex;
                    flex-direction: column;
                    gap: 1rem;
                }
                form input{
                    width: 100%;
                    padding: 1rem 0.5rem;
                    border: 1px solid gray;
                    border-radius: 1rem;
                    font-size: 1rem;
                }
                form input[type="submit"]{
                    width: 10%;
                    background-color: #cadf90;
                    color: blue;
                    border: none;
                    transition: all 400ms ease;
                }form input[type="submit"]:hover{
                    background-color: blue;
                    color: #fff;
                }
                button{
                    width: 10%;
                    background-color: #cadf90;
                    color: blue;
                    border: none;
                    transition: all 400ms ease;
                }button:hover{
                    background-color: blue;
                    color: #fff;
                }
                .image-preview{
                    display:flex;
                    align-items:center;
                    justify-content:center;
                }
                .image-preview img{
                    width:300px;
                    height:200px;
                }
                .input-file {
                    display: none;
                    align-items: center;
                    justify-content: center;
                }

                .file-label {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: #fff;
                    border-radius: 4px;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }

                .file-label:hover {
                    background-color: #0056b3;
                }

                .file-label span {
                    margin-right: 8px;
                }

                .file-label svg {
                    fill: currentColor;
                    width: 20px;
                    height: 20px;
                }
                select {
                    width: 100%;
                    padding: 1rem 0.5rem;
                    border: 1px solid gray;
                    border-radius: 1rem;
                    font-size: 1rem;
                    margin-bottom:1rem;
                }
                #create{
                    display:none;
                }
                #choose{
                    display:flex;
                    flex-direction:column;
                    gap:2rem;
                }
                @media screen and (max-width:600px) {
                    form input[type="submit"]{
                    width: 40%;
                    }
                }
</style>
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Create Playlist</h2>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" id="create">
                        <div class="image-preview">
                            <img id="preview" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image ?>" alt="Profile Image">
                        </div>
                        <div class="input-field">
                        <input type="file" id="file-input" class="input-file" name="image" onchange="displayFileName(); previewImage(event)" required value="<?php echo $image ?>">
                        <label for="file-input" class="file-label">
                            <span>Choose a file</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 2L2 12h3v8h14v-8h3L12 2zm4 14h-2v-2h2v2zm0-4h-2V7h2v5z" />
                            </svg>
                        </label>
                        </div>
                        <div>
                            <input type="text" name="name" placeholder="Enter Playlist name" required value="<?php echo $name ?>">
                        </div>
                        <div>
                            <input type="text" name="description" placeholder="Playlist Description" required value="<?php echo $description ?>">
                        </div> 
                        <div>
                                <select name="course" required>
                                <option value="">Select Course</option>
                                <?php
                                if(isset($_SESSION['TEACHER_LOGIN'])){
                                    $email=$_SESSION['TEACHER_EMAIL'];
                                        $res=mysqli_query($con,"SELECT * FROM `course` where email='$email' ");
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            
                                                echo "<option value=".$row['id'].">".$row['name']."</option>";
                                            
                                        } }
                                    ?>
                        </div>
                        <div>
                            <input type="submit" name="create" value="Create Playlist">
                            <input type="submit" id="choose_btn" value="Choose Playlist">
                        </div>
                        
                    </form>
                    
                    <form action="" method="post" enctype="multipart/form-data" id="choose">
                        <div>
                                <select name="name" required>
                                <option value="">Select Playlist</option>
                                    <?php
                                     if(isset($_SESSION['TEACHER_LOGIN'])){
                                        $email=$_SESSION['TEACHER_EMAIL'];
                                        $res=mysqli_query($con,"SELECT * FROM `playlist` where email='$email'");
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            
                                                echo "<option value=".$row['id'].">".$row['name']."</option>";
                                            
                                        } }
                                    ?>
                        </div>
                        <div>
                            
                        </div>
                        <div style="margin-top:1rem;">
                            <input type="submit" name="go" value="Go to">
                            <input type="submit" id="create_btn" value="Create Playlist">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
    <script>
        function displayFileName() {
        const fileInput = document.getElementById('file-input');
        const fileName = fileInput.value.split('\\').pop(); // Extract the file name from the file path
        const spanElement = document.querySelector('.file-label span');
        spanElement.textContent = fileName;
        }
        function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var preview = document.getElementById('preview');
            preview.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    const choose_btn = document.getElementById('choose_btn');
    const choose = document.getElementById('choose');
    const create_btn = document.getElementById('create_btn'); // Corrected this line
    const create = document.getElementById('create');

    choose_btn.addEventListener('click', () => {
        choose.style.display = 'flex';
        create.style.display = 'none';
    });

    create_btn.addEventListener('click', () => { // Added event listener for the create_btn
        choose.style.display = 'none';
        create.style.display = 'flex';
    });

    </script>



    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </script>
</body>

</html>