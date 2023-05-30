<?php 
$errors = array();

if(isset($_POST['submit'])){
    $FirstName = strip_tags($_POST['FirstaName']);
    $SecondName = strip_tags($_POST['SecondName']);
    $LastName = strip_tags($_POST['LastName']);
    $SSN = strip_tags($_POST['ID']);
    $phone = strip_tags($_POST['Phone']);
    $Email = strip_tags($_POST['Email']);
    $ID_Supervisor = strip_tags($_POST['ID_Supervisor']);
    $password1 = strip_tags($_POST['password1']);
    $password2 = strip_tags($_POST['password2']);
    $Rank = strip_tags($_POST['Rank']);
    $gender = isset($_POST['checkbox']) ? $_POST['checkbox'] : array();

    if(empty($FirstName) || empty($SecondName) || empty($LastName) || empty($Email) || empty($ID_Supervisor) || empty($password1) || empty($password2) || empty($SSN) || empty($phone)){
        array_push($errors, "All fields are required");
    }
    if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){ 
        array_push($errors, "Email is not valid");
    }
    if(strlen($password1) < 8){
        array_push($errors, "Password must be at least 8 characters long");
    }
    if($password1 !== $password2){
        array_push($errors, "Passwords do not match");
    }

    // Check if user with the same email or SSN already exists
    include './database.php';
    
    $email_check_query = "SELECT * FROM person WHERE Email='$Email' LIMIT 1";
    $ssn_check_query = "SELECT * FROM person WHERE SSN='$SSN' LIMIT 1";
    $ID_Supervisor_check_query = "SELECT * FROM supervisor WHERE Supervisor_ID='$ID_Supervisor' LIMIT 1";
    $result_email = mysqli_query($conn, $email_check_query);
    $result_ssn = mysqli_query($conn, $ssn_check_query);
    $result_ID_Supervisor = mysqli_query($conn, $ID_Supervisor_check_query);
    
    if(mysqli_num_rows($result_email) > 0){
        array_push($errors, "Email already exists");
    }
    if(mysqli_num_rows($result_ssn) > 0){
        array_push($errors, "SSN already exists");
    }
    if(mysqli_num_rows($result_ID_Supervisor) > 0){
        array_push($errors, "Supervisor ID already exists");
    }else{
        $password_hash = password_hash($password1, PASSWORD_DEFAULT);
        $gender_str = implode(", ", $gender);

        // Prepare and execute the INSERT queries
        $sql_person = "INSERT INTO person (SSN, First_Name, Second_Name, Last_Name, Email, Sex, Phone_number, Password, Work_Type) VALUES ('$SSN', '$FirstName', '$SecondName', '$LastName', '$Email', '$gender_str', '$phone', '$password_hash', 'Supervisor')";
        mysqli_query($conn, $sql_person);

        $sql_supervisor = "INSERT INTO supervisor (Supervisor_ID,Rank,SP_SSN) VALUES ('$ID_Supervisor','$Rank','$SSN')";
        mysqli_query($conn, $sql_supervisor);

        mysqli_close($conn);
    }
}