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
            $playlistId=$_GET['id'];
            $res=mysqli_query($con,"SELECT * FROM `video` WHERE `playlist`='$playlistId'");
            if(mysqli_num_rows($res)){
                while($row=mysqli_fetch_assoc($res)){
                    $video_id=$row['id'];
                    $viewer=mysqli_num_rows(mysqli_query($con,"SELECT * FROM `finish_watch` WHERE `playlist`='$playlistId' and `video_id`='$video_id'"));

                
        ?>
        <tr>
            <td><?php echo $row['name'] ?></td>
            <td><a href="viewer_watch.php?id=<?php echo $row['id'] ?>" style="text-decoration:none;background:green;color:#fff;padding:1rem;border-radius:0.5rem;"><?php echo $viewer ?></a></td>
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