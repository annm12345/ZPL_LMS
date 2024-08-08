<?php
require('top.inc.php');
?>
    <style>
        table {
        width: 80%;
        margin:auto;
        margin-top:2rem;
        border-collapse: collapse;
        margin-bottom: ;
        }
        
        th, td {
        padding: 1.5rem;
        text-align: left;
        border-bottom: 1px solid #ddd;
        }
        
        th {
        background-color: #f2f2f2;
        color: #333;
        }
        
        tr:nth-child(even) {
        background-color: #f2f2f2;
        }
        
        @media screen and (max-width: 600px) {
        table {
            border: 0;
        }
        th, td {
            border-bottom: 1px solid #ddd;
        }
        }
    </style>
    <table>
    <thead>
        <tr>
        <th>Playlist Name</th>
        <th>Viewers</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(isset($_GET['id'])){
            $video_id=$_GET['id'];
            $res=mysqli_query($con,"SELECT * FROM `finish_watch` WHERE `video_id`='$video_id'");
            if(mysqli_num_rows($res)){
                while($row=mysqli_fetch_assoc($res)){
                    $student_id=$row['student_id'];
                    $viewer=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `student` WHERE `id`='$student_id'"));

                
        ?>
        <tr>
            <td><?php echo $viewer['name'] ?></td>
            <td>
                <?php

                $originalDate = $row['added_on']; // The original date and time
                date_default_timezone_set('Asia/Yangon');
                $currentDate = new DateTime(); // The current date and time

                $originalDateTime = new DateTime($originalDate);

                $interval = $currentDate->diff($originalDateTime);

                $yearsAgo = $interval->y;
                $monthsAgo = $interval->m;
                $daysAgo = $interval->d;
                $hoursAgo = $interval->h;
                $minutesAgo = $interval->i;

                if ($yearsAgo > 0) {
                    echo $yearsAgo . " years ago";
                } elseif ($monthsAgo > 0) {
                    echo $monthsAgo . " months ago";
                } elseif ($daysAgo > 0) {
                    echo $daysAgo . " days ago";
                } elseif ($hoursAgo > 0) {
                    echo $hoursAgo . " hours ago";
                } elseif ($minutesAgo > 0) {
                    echo $minutesAgo . " minutes ago";
                } else {
                    echo "Just now";
                }
                ?>
            </td>
        </tr>
        <?php
                }
            }
        }
        ?>
    </tbody>
    </table>
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>