<?php
require('top.inc.php');
$image='';
$name='';
$duration='';
$category='';

$msg='';
if(isset($_GET['id'])){
    $id=get_safe_value($con,$_GET['id']);
    $check_res=mysqli_query($con,"SELECT * FROM `course` WHERE id='$id'");
    $checks=mysqli_num_rows($check_res);
    if($checks>0){
        $row=mysqli_fetch_assoc($check_res);
        $image=$row['image'];
        $name=$row['name'];
        $email=$row['email'];
        $duration=$row['duration'];

        $category=$row['category'];

    }
}
    
if(isset($_POST['update'])){
    $image = $_FILES['image']['name'];
    $image_temp_name = $_FILES['image']['tmp_name'];
    move_uploaded_file($image_temp_name,'../media/image/'.$image);
    $name=get_safe_value($con,$_POST['name']);
    $duration=get_safe_value($con,$_POST['duration']);
   
    $category=get_safe_value($con,$_POST['category']);

  
    
     mysqli_query($con,"UPDATE `course` SET `email`='$email',`name`='$name',`image`='$image',`duration`='$duration',`category`='$category' WHERE id='$id'");
      
      ?>
      <script>
        window.alert('Sucessfully updated ');
        window.location.href='course.php';
      </script>
      
      <?php
    
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
                    margin-top:1rem;
                    width: 10%;
                    background-color: #cadf90;
                    color: blue;
                    border: none;
                    transition: all 400ms ease;
                }form input[type="submit"]:hover{
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
                        <h2>Paper Setting</h2>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
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
                            <input type="text" name="name" placeholder="Enter course name" required value="<?php echo $name ?>">
                        </div> 
                        <div>
                            <input type="text" name="duration" placeholder="Course Duration" required value="<?php echo $duration ?>">
                        </div> 
                        
                        <div>
                            <select name="category" required>
                            <option value="">Select Category</option>
                                <?php
                                    $res=mysqli_query($con,"select * from category order by id asc");
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        if($row['id']==$category)
                                        {
                                            echo "<option selected value=".$row['id'].">".$row['category']."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value=".$row['id'].">".$row['category']."</option>";
                                        }
                                        
                                    }
                                ?>
                        </div>
                        <div>
                            <input type="submit" name="update" value="Update">
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
    </script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>