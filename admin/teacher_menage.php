<?php
require('top.inc.php');
if(isset($_GET['id'])){
    $id=get_safe_value($con,$_GET['id']);
    mysqli_query($con,"DELETE FROM `teacher` WHERE id='$id'");
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
                        <h2>Teachers List</h2>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Image</td>
                                <td>Email</td>
                                <td>Name</td>
                                <td>Age</td>
                                <td>Address</td>
                                <td>Mobile number</td>
                                <td>Enrolled Date</td>
                                <td>Course</td>
                                <td>Duration of course</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                                $res=mysqli_query($con,"SELECT * FROM `teacher` order by id asc");
                                while($row=mysqli_fetch_assoc($res)){
                                    $birthdate=$row['birth'];
                                    $today=date('Y-m-d');
                                    $diff = date_diff(date_create($birthdate), date_create($today));
                                    $age = $diff->format('%y');
                                ?>
                            <tr>
                            
                                <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" alt="" style="width: 75px;border-radius: 1rem;"></td>
                                <td><?php echo $row['name'] ?></td>  
                                <td><?php echo $row['email'] ?></td>  
                                <td><?php echo $age ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['mobile'] ?></td>
                                <td><?php echo $row['added_on'] ?></td>
                                <td><?php echo $row['course'] ?></td>
                                <td><?php echo $row['duration'] ?></td>
                                <td ><a href="teacher_edit.php?id=<?php echo $row['id']  ?>" style="color: lightgreen;">Edit</a></td>
                                <td ><a href="teacher_menage.php?id=<?php echo $row['id']  ?>" style="color: red;">Delete</a></td>
                                
                            </tr>
                            <?php }
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