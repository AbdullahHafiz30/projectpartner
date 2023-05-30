<?php

include './inc/database.php';
session_start();
$ID = $_SESSION['ID_Student'];


$info = "SELECT * from person inner join student ON person.SSN = student.S_SSN where student.Student_ID = '$ID'";

$result = mysqli_query($conn, $info);

if (!$result) {
    die('Error executing query: ' . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

$super = "SELECT * from person where SSN = (select SP_SSN from supervisor where Supervisor_ID = (SELECT Supervisor_ID from team where Team_ID = (SELECT Team_ID from student where Student_ID = '$ID')))";

$result2 = mysqli_query($conn, $super);

if (!$result2) {
    die('Error executing query: ' . mysqli_error($conn));
}
$row2 = mysqli_fetch_assoc($result2);

$pid = "SELECT Project_ID FROM project WHERE Team_ID =(SELECT Team_ID FROM student WHERE Student_ID = '$ID')";

$result1 = mysqli_query($conn, $pid);

if (!$result1) {
    die('Error executing query: ' . mysqli_error($conn));
}
$row1 = mysqli_fetch_assoc($result1);

$p = "SELECT * FROM `tasks` WHERE priority = 'high'";

$result3 = mysqli_query($conn, $p);

if (!$result3) {
    die('Error executing query: ' . mysqli_error($conn));
}
$row3 = mysqli_fetch_assoc($result3);

include './inc/DBclose.php';
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/Pacifico.css">
    <link rel="stylesheet" href="./css/sinfopage.css">

    <title>Home Page</title>

</head>

<body>
    <header>
        <div class="mark">
            project <img src="./images/gradcapblue.png" alt="gradcap"> partner
        </div>

        <nav class="navigation">
      <a href="http://localhost/projectpartner/studenthomepage.php">Home</a>
      <a href="http://localhost/projectpartner/projectfiles.php">Project Files</a>
      <a href="#">Join Team</a>
      <a href="http://localhost/projectpartner/tasks.php">Tasks</a>
      <a href="http://localhost/projectpartner/teammembers.php#">Team Members</a>
      <button onclick="window.location.href='//localhost/projectpartner/landingpage.php'" class="btnlogout">Log
        out</button>
    </nav>
    </header>

    <main class="sinfo">
        <section class="table_header">
            <h1>My informatin</h1>
        </section>
        <section class="table_body">
            <table style="width:100%">
                <tr>
                    <th style="width:30%">Important task</th>
                    <td>
                        <?php echo htmlspecialchars($row3['Title']) ?>
                    </td>
                </tr>
                <tr>
                    <th style="width:30%">Project ID</th>
                    <td>
                        <?php echo htmlspecialchars($row1['Project_ID']) ?>
                    </td>
                </tr>
                <tr>
                    <th style="width:30%">Team ID</th>
                    <td>
                        <?php echo htmlspecialchars($row['Team_ID']) ?>
                    </td>
                </tr>
                <tr>
                    <th style="width:30%">ID</th>
                    <td>
                        <?php echo htmlspecialchars($row['Student_ID']) ?>
                    </td>
                </tr>
                <tr>
                    <th style="width:30%">Supervisor Email</th>
                    <td>
                        <?php echo htmlspecialchars($row2['Email']) ?>
                    </td>
                </tr>
                <tr>
                    <th style="width:30%">Project Supervisor</th>
                    <td>
                        <?php echo htmlspecialchars($row2['First_Name']) . ' ' . htmlspecialchars($row2['Second_Name']) . ' ' . htmlspecialchars($row2['Last_Name']) ?>
                    </td>
                </tr>
                <tr>
                    <th style="width:30%">Email</th>
                    <td>
                        <?php echo htmlspecialchars($row['Email']) ?>
                    </td>
                </tr>
                <tr>
                    <th style="width:30%">Name</th>
                    <td>
                        <?php echo htmlspecialchars($row['First_Name']) . ' ' . htmlspecialchars($row['Second_Name']) . ' ' . htmlspecialchars($row['Last_Name']) ?>
                    </td>
                </tr>
                <tr>
                    <th style="width:30%">Social Security number</th>
                    <td>
                        <?php echo htmlspecialchars($row['SSN']) ?>
                    </td>
                </tr>
                <tr>
                    <th style="width:30%">Phone Number</th>
                    <td>
                        <?php echo htmlspecialchars($row['Phone_number']) ?>
                    </td>
                </tr>
            </table>
        </section>
    </main>
</body>

</html>