<?php

$errors = array();

if (isset($_POST['login'])) {
    $ID_Student = strip_tags($_POST['ID_Student']);
    $password = strip_tags($_POST['password']);

    if (empty($ID_Student) || empty($password)) {
        array_push($errors, "ID_Student and password are required");
    }

    if (count($errors) === 0) {
        include './inc/database.php';

        $student_check_query = "SELECT * FROM student WHERE Student_ID='$ID_Student' LIMIT 1";
        $result_student = mysqli_query($conn, $student_check_query);

        if (mysqli_num_rows($result_student) > 0) {
            $row = mysqli_fetch_assoc($result_student);
            $ssn = $row['S_SSN'];

            $person_check_query = "SELECT * FROM person WHERE SSN='$ssn' LIMIT 1";
            $result_person = mysqli_query($conn, $person_check_query);

            if (mysqli_num_rows($result_person) > 0) {
                $person_row = mysqli_fetch_assoc($result_person);
                $stored_password = $person_row['Password'];

                if (password_verify($password, $stored_password)) {
                    session_start();
                    $_SESSION['ID_Student'] = $ID_Student;
                    $_SESSION['Student_ID'] = $row['Student_ID'];
                    
                    header("Refresh:1; url=studenthomepage.php");

                    exit();
                } else {
                    array_push($errors, "Invalid password");
                }
            } else {
                array_push($errors, "Person not found");
            }
        } else {
            array_push($errors, "Student not found");
        }

        mysqli_close($conn);
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
    <link rel="stylesheet" href="./css/stlyel_login.css">
    <title>Login</title>
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

    <div class="Login">
        <form action="" method="POST">
            <div>
                <h1>Login</h1>
            </div>

            <div class="ID_Student">
                <label for="">ID_Student</label><br>
                <input type="text" name="ID_Student" id="" placeholder="ID_Student">
            </div><br>
            <div class="Password">
                <label>Password</label><br>
                <input type="password" name="password" id="" placeholder="Password">
            </div><br>
            <div>
                <input type="submit" value="Login" class="llogin" name="login"><br><br>
                <input type="submit" value="Signup" class="Signup" name="Signup">
            </div>
            <?php if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='printErrors'>$error</div>";
                }
            } ?>
        </form>
    </div>
</body>

</html>