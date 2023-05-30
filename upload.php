<?php
include_once './inc/database.php';
include './inc/login.php';
session_start();
$ID = $_SESSION['ID_Student'];


$pro_query = "SELECT Project_ID from project where Team_id = (SELECT Team_id from student where Student_ID = $ID)";
$result = mysqli_query($conn, $pro_query);
$row = mysqli_fetch_assoc($result);
$projectID = $row['Project_ID'];

if (isset($_POST['upload'])) {
    $file_name = $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $uploaded_time = date('Y-m-d H:i:s');
    $folder = "upload/";

    $new_size = $file_size / 1024;

    $final_file = strtolower($file_name);

    $final_file = str_replace(' ', '-', $final_file);

    if (move_uploaded_file($file_loc, $folder . $final_file)) {
        $sql = "INSERT INTO file (Project_ID, file_name, uploaded_time, size) VALUES ('$projectID','$final_file', '$uploaded_time', '$new_size')";

        mysqli_query($conn, $sql);

        echo "File successfully uploaded";

        header('Refresh: 1; URL=projectfiles.php');
        exit(); // Terminate the script after redirecting
    } else {
        echo "Error. Please try again";
    }
}
?>