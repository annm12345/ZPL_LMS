<?php
require('top.inc.php');
?>
<!----======================schedule==================-->
<style>
                .details{
                    display: grid;
                    grid-template-columns: 1fr;
                }
            </style>
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Today Schedule</h2>
                        <a href="Scheduleall.php" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Course</td>
                                <td>Schedule</td>
                                <td>Date</td>
                                <td>Level</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                             if(isset($_SESSION['TEACHER_LOGIN'])){
     
                                $email=$_SESSION['TEACHER_EMAIL'];
                                $res=mysqli_query($con,"select * from schedule where email='$email' order by date desc");
                                while($row=mysqli_fetch_assoc($res)){
                                    $id=$row['name'];
                            ?>
                            <tr><?php
                                $course_res=mysqli_query($con,"select * from course where id='$id'");
                               $course_row=mysqli_fetch_assoc($course_res);
                               $course_name=$course_row['name'];
                            ?>
                                <td><?php echo $course_name ?></td>
                                <td><?php echo $row['description'] ?></td>
                                <td><?php echo $row['date'] ?></td>
                                <td><span class="status"><?php echo $row['badge'] ?></span></td>
                            </tr>
                             <?php } }
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