<?php
include './inc/database.php';
include './inc/Slogin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/lnavbar.css">
    <link rel="stylesheet" href="./css/Pacifico.css">
    <title>Supervisor Login</title>
    <link rel="stylesheet" href="./css/stlyel_login.css">
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
            <div><h1>Login</h1></div>
            <?php if(count($errors) > 0){
                foreach($errors as $error){
                    echo "<div class='printErrors'>$error</div>";
                }
            }?>
            <div class="ID_Supervisor">
                <label for="">ID Supervisor</label><br>
                <input type="text" name="ID_Supervisor" id="" placeholder="ID Supervisor">
            </div><br>
            <div class="Password">
                <label>Password</label><br>
                <input type="password" name="password" id="" placeholder="Password">
            </div><br>
            <div>
                <input type="submit" value="Login" class="llogin" name="login"><br><br>
                <input type="submit" value="Signup" class="Signup" name="Signup">
            </div>
        </form>    
    </div>
</body>
</html>
