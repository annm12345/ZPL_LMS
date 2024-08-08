<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Viewer</title>
    <link rel="shortcut icon" href="favicon.svg" type="image/svg+xml">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .document-container {
            width: 100%;
            height: 100vh; /* Set the desired height */
        }
    </style>
</head>
<body>
    <?php
    // Check if file path is provided
    if(isset($_GET['file'])) {
        $file_path = $_GET['file'];

        // Get file extension
        $file_ext = pathinfo($file_path, PATHINFO_EXTENSION);

        // Check file extension and display accordingly
        if($file_ext === 'pdf') {
            echo '<div class="document-container">';
            echo '<embed src="filelist/' . $file_path . '" type="application/pdf" width="100%" height="100%">';
            echo '</div>';
        } elseif($file_ext === 'doc' || $file_ext === 'docx') {
            echo '<div class="document-container">';
            echo '<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=' . urlencode("http://localhost/ZPL_lms/filelist/" . $file_path) . '" width="100%" height="100%" frameborder="0"></iframe>';
            echo '</div>';
        } else {
            echo 'Unsupported file format.';
        }
    } else {
        echo 'File not found.';
    }
    ?>
</body>
</html>
