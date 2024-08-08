<?php
require('top.inc.php');

if(isset($_GET['listname'])) {
    $filelist = get_safe_value($con, $_GET['listname']);
    if(isset($_SESSION['TEACHER_LOGIN'])) {
        $email = $_SESSION['TEACHER_EMAIL'];
        if(isset($_POST["upload"])) {
            $title = $_POST['title'];

            if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
                $title = $_POST["title"];
                $file_name = $_FILES["file"]["name"];
                $file_tmp = $_FILES["file"]["tmp_name"];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                
                // Define target directory to store the uploaded files
                $target_dir = "../filelist/";
                
                // Generate unique file name
                $unique_filename = uniqid() . '_' . $file_name;
                $target_file = $target_dir . $unique_filename;


                // Check file extension
                $allowed_extensions = array("pdf", "doc", "docx");
                if(!in_array($file_ext, $allowed_extensions)) {
                    echo "Error: Only PDF, DOC, and DOCX files are allowed.";
                } else {
                    // Move uploaded file to target directory
                    if(move_uploaded_file($file_tmp, $target_file)) {
                        
                        // Insert file details into database
                        $added_on = date('Y-m-d H:i:s');
                        $sql = "INSERT INTO `file`(`email`, `name`, `src`, `added_on`, `filelist`) VALUES ('$email', '$title', '$unique_filename', '$added_on', '$filelist')";
                        if(mysqli_query($con, $sql)) {
                            ?>
                            <script>
                                window.alert(" File uploaded successfully.");
                            </script>
                        <?php
                        } else {
                            echo "Error inserting file details into database: " . mysqli_error($con);
                        }
                    } else {
                        ?>
                            <script>
                                window.alert("Error uploaded.");
                            </script>
                        <?php
                    }
                }
            } else {
                ?>
                <script>
                    window.alert("Error: No file uploaded.");
                </script>
                <?php
            }
        }
    } 
}
?>

    <style>

        .details {
            display: grid;
            grid-template-columns: 1fr;
        }

        a {
            text-decoration: none;
        }

        .cardHeader {
            background-color: #8C52FF;
            color: #fff;
            text-align: center;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }

        h2 {
            margin-top: 0;
            text-align: center;
            color: #8C52FF;
        }

        form {
            margin-top: 3rem;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input {
            width: 100%;
            padding: 1rem 0.5rem;
            border: 1px solid gray;
            border-radius: 1rem;
            font-size: 1rem;
        }

        form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        form textarea {
            height: 100px;
        }

        .form-group .cover-image-preview,
        .form-group .video-preview {
            max-width: 100%;
            margin-top: 10px;
        }

        .form-group .cover-image-preview img,
        .form-group .video-preview video {
            width: 100%;
            border-radius: 5px;
        }

        .form-group .submit-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        .bar {
            display: grid;
            grid-template-columns: 1fr;
            border-radius: 3px;
            padding: 10px;
            background-color: #f2f2f2;
            margin-top: 20px;
        }

        button {
            border: 0px;
            width: 100px;
            padding: 10px 40px;
            border-radius: 3px;
            color: #8C52FF;
            cursor: pointer;
            text-align: center;
            font-weight: bold;
        }

        button:hover {
            background: #8C52FF;
            color: #fff;
        }

        .progress {
            background-color: #fff;
            height: 40px;
            border: 1px solid gray;
            border-radius: 4px;
        }

        .progress .progress-bar {
            width: 0%;
            height: 100%;
            background-color: #8C52FF;
            border-radius: 4px;
        }

        .action {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .action span {
            line-height: 35px;
            text-align: center;
            font-weight: bold;
        }

        .custom-file {
        position: relative;
        display: inline-block;
        }

        .custom-file-input {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        }

        .custom-file-label {
        display: block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        .custom-file-label::after {
        content: "Choose a file";
        }

        .custom-file-input:focus ~ .custom-file-label,
        .custom-file-input:valid ~ .custom-file-label {
        background-color: #0056b3;
        }

        .custom-file-input:valid ~ .custom-file-label::after {
        content: attr(data-file-name);
        }


        @media screen and (max-width: 600px) {
            form input[type="submit"] {
            width: 50%;
            }
        }
        
  </style>
      

          <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>File Upload</h2>
                    </div>
            <form id="form" action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="title">file Title:</label>
                <input type="text" name="title" id="title" placeholder="File Title" required>
              </div>
              <div class="form-group">
                <label for="video">Lesson File:</label>
                <input type="file" name="file" id="file" class="input-file"  required>
          
              </div>
              <div class="form-group">
                <input type="submit" name="upload" id="upload" value="Upload file" class="submit-btn">
              </div>
            </form>
            
            </div>
            </div>
        </div>
    </div>
                

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </script>

  