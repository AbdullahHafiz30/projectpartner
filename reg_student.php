<?php
$errors = array();
$student = 'student';

if(isset($_POST['submit'])){
    $FirstaName = strip_tags($_POST['FirstaName']);
    $SecondName = strip_tags($_POST['SecondName']);
    $LastName = strip_tags($_POST['LastName']);
    $SSN = strip_tags($_POST['ID']);
    $phone = strip_tags($_POST['Phone']);
    $Email = strip_tags($_POST['Email']);
    $ID_Student = strip_tags($_POST['ID_Student']);
    $password1 = strip_tags($_POST['password1']);
    $password2 = strip_tags($_POST['password2']);
   
    $gender = isset($_POST['checkbox']) ? $_POST['checkbox'] : array();

    if(empty($FirstaName) || empty($SecondName) || empty($LastName) || empty($Email) || empty($ID_Student) || empty($password1) || empty($password2) || empty($SSN) || empty($phone)){
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
    include './inc/database.php';
    
    $email_check_query = "SELECT * FROM person WHERE Email='$Email' LIMIT 1";
    $ssn_check_query = "SELECT * FROM person WHERE SSN='$SSN' LIMIT 1";
    $ID_Student_check_query="SELECT * FROM student WHERE Student_ID='$ID_Student' LIMIT 1";
    $result_email = mysqli_query($conn, $email_check_query);
    $result_ssn = mysqli_query($conn, $ssn_check_query);
    $result_ID_Student = mysqli_query($conn, $ID_Student_check_query);
    
    if(mysqli_num_rows($result_email) > 0){
        array_push($errors, "Email already exists");
    }
    if(mysqli_num_rows($result_ssn) > 0){
        array_push($errors, "SSN already exists");
    }
    if(mysqli_num_rows($result_ID_Student) > 0){
      array_push($errors, "Student ID already exists");
    }
    
    if(count($errors) === 0){
        $password_hash = password_hash($password1, PASSWORD_DEFAULT);
        $gender_str = implode(", ", $gender);

        $sql = "INSERT INTO person(SSN , First_Name, Second_Name, Last_Name, Email, Sex, Phone_number, password, Work_Type) VALUES
            ('$SSN', '$FirstaName', '$SecondName', '$LastName', '$Email', '$gender_str', '$phone', '$password_hash', 'student')";
        mysqli_query($conn, $sql);

        $sql1 = "INSERT INTO `student`(`Student_ID`,`S_SSN`) VALUES ('$ID_Student','$SSN')";
        mysqli_query($conn, $sql1);

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/lnavbar.css">
    <link rel="stylesheet" href="./css/Pacifico.css">
    <link rel="stylesheet" href="./css/stlyel_Signup.css">
    <title>Signup</title>
    <link rel="stylesheet" href="stlyel_Signup.css">
</head>
<body>

<header>
        <div class="mark">
            project <img src="./images/gradcapblue.png" alt="gradcap"> partner
        </div>

        <nav class="navigation">
            <a href="http://localhost/projectpartner/landingpage.php">Home</a>
            <button onclick="window.location.href='//localhost/projectpartner/login_super.php'" class="Sbtnlgoin">Teacher
                Log in</button>
            <button onclick="window.location.href='//localhost/projectpartner/reg_super.php'" class="Sbtnsignup">Teacher
                Sign up</button>

            <button onclick="window.location.href='//localhost/projectpartner/login_student.php'"
                class="Sbtnlgoin">Student Log in</button>
            <button onclick="window.location.href='//localhost/projectpartner/reg_student.php'" class="Sbtnsignup">Student
                Sign up</button>
        </nav>
    </header>
    <div class="Signup">
        <form action="" method="POST">
            <div><h1>Sign Up</h1></div>
            <?php if(count($errors) > 0){
                foreach($errors as $error){
                    echo "<div class='printErrors'>$error</div>";
                }
            }?>
            <div class="Name">
                <label for="">Name</label><br>
                <input type="text" name="FirstaName" id="" placeholder="First Name">
                <input type="text" name="SecondName" id="" placeholder="Second Name">
                <input type="text" name="LastName" id="" placeholder="Last Name">
            </div><br>
            
            <div class="ID_Student">
                <label for="">ID_Student</label><br>
                <input type="text" name="ID_Student" id="" placeholder="ID_Student">
            </div><br>

            <div class="ID_SSN">
                <label for="">Social Security Number</label><br>
                <input type="text" name="ID" id="" placeholder="SSN">
            </div><br>

            <div class="phone number">
                <label for="">The Phone number</label><br>
                <input type="text" name="Phone" id="" placeholder="The Phone number">
            </div><br>

            <div class="Email">
                <label for="">Email</label><br>
                <input type="email" name="Email" id="" placeholder="Email">
            </div><br>
            <div class="gender">
                <label for="">Select the gender:</label>
                <label>Male</label>
                <input type="checkbox" name="checkbox[]" id="" value="Male">
                <label>Female</label>
                <input type="checkbox" name="checkbox[]" id="" value="Female">
            </div><br>
            
            <div class="Password">
                <label>Password</label><br>
                <input type="password" name="password1" id="" placeholder="Password">
                <input type="password" name="password2" id="" placeholder="Retype Password">
            </div><br>
            <div>
                <input type="submit" value="Create an Account" class="submit" name="submit">
            </div>

        </form>    
    </div>
</body>
</html>
