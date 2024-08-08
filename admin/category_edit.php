<?php
require('top.inc.php');


$category='';
$msg='';
if(isset($_GET['id'])){
    $id=get_safe_value($con,$_GET['id']);
    $check_res=mysqli_query($con,"SELECT * FROM `category` WHERE id='$id'");
    $checks=mysqli_num_rows($check_res);
    if($checks>0){
        $row=mysqli_fetch_assoc($check_res);
        $category=$row['category'];
    }
}
if(isset($_POST['add'])){
    
    $category=get_safe_value($con,$_POST['category']);

    $res=mysqli_query($con,"SELECT * FROM `category` WHERE category='$category'");
    $check=mysqli_num_rows($res);
    if($check>0){
        $msg='Category already exist';
    }else{
        mysqli_query($con,"insert into `category` (`category`) values ('$category') ");
      
        ?>
        <script>
          window.alert('Sucessfully added ');
          window.location.href='category.php';
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
                @media screen and (max-width:600px) {
                    form input[type="submit"]{
                    width: 40%;
                    }
                }
            </style>
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Add Category</h2>
                    </div>
                    <form action="" method="post">
                        <div>
                            <input type="text" name="category" placeholder="Category" required value="<?php echo $category ?>">
                        </div>
                        <div>
                            <input type="submit" name="add" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>