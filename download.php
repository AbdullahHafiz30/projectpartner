<?php
include './inc/database.php';

if(isset($_GET['file_id'])) {
    $file_id = $_GET['file_id'];

    //Fetch file information from the database
    $sql = "SELECT * FROM file WHERE id = $file_id";
    $result = mysqli_query($conn, $sql);
    $file = mysqli_fetch_assoc($result);

    $file_path = 'upload/' . $file['file_name'];

    //Check if the file exists
    if (file_exists($file_path)) {
        //Set appropriate headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_path));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        echo 'File not found.';
    }
}
?>