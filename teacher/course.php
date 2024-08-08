<?php
require('top.inc.php');
if(isset($_GET['id'])){
    $id=get_safe_value($con,$_GET['id']);
    mysqli_query($con,"DELETE FROM `course` WHERE id='$id'");
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
            </style>
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Papers List</h2>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Image</td>
                                <td>Paper Name</td>
                                
                                <td>Teacher</td>
                                <td>Duration</td>
                                <td>Course</td>
                                
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                            if(isset($_SESSION['TEACHER_LOGIN'])){
     
                                $email=$_SESSION['TEACHER_EMAIL'];
                                $res=mysqli_query($con,"SELECT * FROM `course` where email='$email'");
                                while($row=mysqli_fetch_assoc($res)){
                                    $catid=$row['category'];
                                    $email=$row['email'];
                                    $catrow=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `category` where id='$catid'"));
                                    $teacher_row=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `teacher` where email='$email'"));
                                ?>
                            <tr>
                                <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" alt="" style="width: 75px;border-radius: 1rem;"></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $teacher_row['name'] ?></td>
                                <td><?php echo $row['duration'] ?></td>
                               
                                <td><?php echo $catrow['category'] ?></td>
                                
                                <td ><a href="course_edit.php?id=<?php echo $row['id'] ?>" style="color: lightgreen;">Edit</a></td>
                                <td ><a href="course.php?id=<?php echo $row['id'] ?>" style="color: red;">Delete</a></td>
                            </tr>
                            <?php } 
                             }
                            ?>
                        </tbody>
                    </table>
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