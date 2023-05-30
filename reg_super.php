<?php
include './inc/database.php';
include './inc/Sreg.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/lnavbar.css">
    <link rel="stylesheet" href="./css/Pacifico.css">
    <title>Supervisor Signup</title>
    <link rel="stylesheet" href="./css/stlyel_Signup.css">
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
            <div>
                <h1>Sign Up</h1>
            </div>
            <?php if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='printErrors'>$error</div>";
                }
            } ?>
            <div class="Name">
                <label for="">Name</label><br>
                <input type="text" name="FirstaName" id="" placeholder="First Name">
                <input type="text" name="SecondName" id="" placeholder="Second Name">
                <input type="text" name="LastName" id="" placeholder="Last Name">
            </div><br>

            <div class="ID_Student">
                <label for="">Supervisor ID</label><br>
                <input type="text" name="ID_Supervisor" id="" placeholder="Supervisor ID">
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
            <div class="Rank">
                <label for="">Rank</label><br>
                <input type="text" name="Rank" id="" placeholder="The Rank">
            </div>
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