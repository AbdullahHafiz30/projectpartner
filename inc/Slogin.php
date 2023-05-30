<?php

$errors = array();

if(isset($_POST['login'])){
    $ID_Supervisor = strip_tags($_POST['ID_Supervisor']);
    $password = strip_tags($_POST['password']);

    if(empty($ID_Supervisor) || empty($password)){
        array_push($errors, "ID Supervisor and password are required");
    }

    if(count($errors) === 0){
        // Check if user exists in the database
        include './database.php';
        
        $student_check_query = "SELECT * FROM supervisor WHERE Supervisor_ID='$ID_Supervisor' LIMIT 1";
        $result_student = mysqli_query($conn, $student_check_query);

        if(mysqli_num_rows($result_student) > 0){
            $row = mysqli_fetch_assoc($result_student);
            $ssn = $row['SP_SSN'];

            $person_check_query = "SELECT * FROM person WHERE SSN='$ssn' LIMIT 1";
            $result_person = mysqli_query($conn, $person_check_query);

            if(mysqli_num_rows($result_person) > 0){
                $person_row = mysqli_fetch_assoc($result_person);
                $stored_password = $person_row['Password'];

                if(password_verify($password, $stored_password)){
                    // Password is correct, redirect to a secure page or perform further actions
                    session_start();
                    $_SESSION['ID_Supervisor'] = $ID_Supervisor;
                    $_SESSION['ID_Supervisor'] = $row['Supervisor_ID'];

                    header("Location: superhomepage.php");
                    exit();
                } else {
                    array_push($errors, "Invalid password");
                }
            } else {
                array_push($errors, "Person not found");
            }
        } else {
            array_push($errors, "Supervisor not found");
        }
        
        mysqli_close($conn);
    }
}