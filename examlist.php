<?php
require('top.inc.php');
if(isset($_GET['id'])){
  $id=get_safe_value($con,$_GET['id']);
  
}
?>



<style>
    .table {
        width: 80%;
        border-collapse: collapse;
        border-spacing: 0;
        background-color: #fff;
        margin:auto;
    }

    .table th,
    .table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #f2f2f2;
        color: #333;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table-responsive {
        overflow-x: auto;
    }

</style>
<main>
    <article>
        <section class="section learning">
            <div class="table-responsive" >
                <table class="table">
                    <thead>
                        <tr>
                            <th>Exam Name</th>
                            <th>Exam paper</th>
                            <th>Exam Teacher</th>
                            <th>Exam Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = mysqli_query($con, "SELECT * FROM `exam_list` WHERE `course`='$id' order by `date` ASC");
                        while($row = mysqli_fetch_assoc($res)){
                            $course=$row['course'];
                            $email=$row['email'];
                            $course_row=mysqli_fetch_assoc( mysqli_query($con, "SELECT * FROM `course` WHERE id='$course'"));
                            $teacher_row=mysqli_fetch_assoc( mysqli_query($con, "SELECT * FROM `teacher` WHERE email='$email'"));
                        ?>
                        <tr>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $course_row['name'] ?></td>
                            <td><?php echo $teacher_row['name'] ?></td>
                            <td><?php echo $row['date'] ?></td> 
                            <td><a href="question_list.php?id=<?php echo $row['id'] ?>"><i class="fa-solid fa-eye" style="color:green;padding:0.5rem;font-size:1rem;"></i></a> </td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </section>
    </article>
</main>









  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>