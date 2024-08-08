<?php 
require('top.inc.php');
?>
<style>
    .grid-list{
        width:100%;
        display:grid;
        grid-template-columns:1rem;

    }
    table{
        width:100%;
        border-collapse:collapse;
    }
    tr th, tr td{
        border:1px solid black;
        padding:0.5rem;
    }
</style>
<section class="section " aria-label="enroll-list">
        <div class="container">
        <p class="section-subtitle">Enrolled List</p>

        <h2 class="h2 section-title">Here You have been enrolled !</h2>
          
        <table>
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_GET['id'])){
                    $id=get_safe_value($con,$_GET['id']);
                    $res=mysqli_query($con,"select * from enroll where student_id='$id'");
                    while($row=mysqli_fetch_assoc($res)){
                    $cat_id=$row['course_id'];
                ?>
                <tr>
                    <?php
                    $course_res=mysqli_query($con,"select * from category where id='$cat_id'");
                    $course_row=mysqli_fetch_assoc($course_res);
                    ?>
                    <td><?php echo $course_row['category'] ?></td>
                   
                    <?php if($row['action']==0){
                        ?>
                    <td style="color:red">Not Accept</td>
                    <?php }else{
                        ?>
                        <td style="color:green">Accept</td>
                        <?php
                    }
                    ?>
                </tr>
                <?php } }
                ?>
            </tbody>
        </table>

        </div>
      </section>

      <?php
require('foot.php');
?>