<?php
require('top.php')
?>
            <!----======================schedule==================-->
            <style>
                a{
                    text-decoration:none;
                }
                .details{
                    display: grid;
                    grid-template-columns: 1fr;
                }
            </style>
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Today Enrolled for teacher</h2>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Image</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Age</td>
                                <td>Address</td>
                                <td>Mobile number</td>
                                <td>Enrolled Date</td>
                                <td>Courses</td>
                                <td>Type</td>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                                date_default_timezone_set('Asia/Yangon');
                                $added_on=date('Y-m-d');
                                echo $added_on;
                                $res=mysqli_query($con,"SELECT * FROM `teacher` where `added_on`='$added_on'");
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
                                <td><?php echo 'teacher' ?></td>
                               
                            </tr>
                            <?php }
                                ?>
                                
                        </tbody>
                    </table>
                </div>
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Today Enrolled for student</h2>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td style="text-align:center;">Image</td>
                                <td style="text-align:center;">Name</td>
                                <td style="text-align:center;">Age</td>
                                <td style="text-align:center;">Enrolled Date</td>
                                <th style="text-align:center;">Course</th>
                                <th style="text-align:center;">Action</th>
                              
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                    $res=mysqli_query($con,"select * from enroll order by id asc");
                                    while($row=mysqli_fetch_assoc($res)){
                                    $student_id=$row['student_id'];
                                    $course_id=$row['course_id'];
                                ?>
                            <tr>
                                <?php
                                $student_res=mysqli_query($con,"select * from student where id='$student_id'");
                                $student_row=mysqli_fetch_assoc($student_res);
                                $course_res=mysqli_query($con,"select * from category where id='$course_id'");
                                $course_row=mysqli_fetch_assoc($course_res);
                                $birthdate=$student_row['birth'];
                                $today=date('Y-m-d');
                                $diff = date_diff(date_create($birthdate), date_create($today));
                                $age = $diff->format('%y');
                                ?>
                                <td style="text-align:center;"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$student_row['image'] ?>" alt="" style="width: 75px;border-radius: 1rem;"></td>
                                <td style="text-align:center;"><?php echo $student_row['name'] ?></td>
                                <td style="text-align:center;"><?php echo $age ?></td>
                                <td style="text-align:center;"><?php echo $row['added_on'] ?></td>
                                <td style="text-align:center;"><?php echo $course_row['category'] ?></td>
                               
                                <?php
                                if($row['action']==0){
                                    ?>
                                <td style="text-align:center;"><a href="?id=<?php echo $row['id'] ?>&action=accept" style="background-color:red;padding:1rem;border-radius:10px;">Not Accept</a></td>
                                <?php } else{
                                    ?>
                                    <td style="text-align:center;"><a href="?id=<?php echo $row['id'] ?>&action=notaccept" style="background-color:green;padding:1rem;border-radius:10px;">Accept</a></td>
                                    <?php
                                }
                                ?>
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