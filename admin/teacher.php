<?php
require('top.php');
?>


            <!-- ================ Order Details List ================= -->
            <style>
            .details{
                display: grid;
                grid-template-columns: 1fr;
            }
            </style>
            
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Teachers List</h2>
                        <a href="teacher_menage.php" class="btn">View All</a>
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
                                <td>Course</td>
                                <td>Duration of course</td>
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
                                <td><img src="../media/image/<?php echo $row['image'] ?>" alt="" style="width: 75px;border-radius: 1rem;"></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $age ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['mobile'] ?></td>
                                <td><?php echo $row['added_on'] ?></td>
                                <td><?php echo $row['course'] ?></td>
                                <td><?php echo $row['duration'] ?></td>
                               
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