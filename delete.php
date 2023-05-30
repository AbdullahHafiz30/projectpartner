<?php
include './inc/database.php';

if(isset($_GET['file_id'])) {
    $file_id = $_GET['file_id'];

    //Fetch file information from the database
    $sql = "SELECT * FROM file WHERE id = $file_id";
    $result = mysqli_query($conn, $sql);
    $file = mysqli_fetch_assoc($result);

    $file_path = 'upload/' . $file['file_name'];

    //Delete file from the server
    if (file_exists($file_path)) {
        unlink($file_path);

        //Delete file record from the database
        $delete_sql = "DELETE FROM file WHERE id = $file_id";
        mysqli_query($conn, $delete_sql);

        echo 'File deleted successfully.';
        header('Refresh: 1; URL=projectfiles.php');
    } else {
        echo 'File not found.';
    }
}
?>
