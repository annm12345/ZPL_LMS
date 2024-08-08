<?php
require('top.inc.php');
if(isset($_GET['id'])){
    $id=get_safe_value($con,$_GET['id']);
    mysqli_query($con,"DELETE FROM `category` WHERE id='$id'");
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
                        <h2>Courses</h2>
                        <a href="category_edit.php" class="btn">Add</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Courses</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>

                        <tbody>
                            
                        <?php
                                $res=mysqli_query($con,"SELECT * FROM `category` order by id asc");
                                while($row=mysqli_fetch_assoc($res)){
                                ?>
                        <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['category'] ?></td>
                                <td ><a href="category_edit.php?id=<?php echo $row['id'] ?>" style="color: lightgreen;">Edit</a></td>
                                <td ><a href="category.php?id=<?php echo $row['id'] ?>" style="color: red;">Delete</a></td>
                               
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