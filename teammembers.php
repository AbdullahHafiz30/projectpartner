<?php
include './inc/database.php';
session_start();
$ID = $_SESSION['ID_Student'];

$team = "SELECT First_Name, Second_Name, Last_name, Student_ID, Email FROM student INNER JOIN person on person.SSN = student.S_SSN where student.Team_ID = (SELECT Team_ID from student where Student_ID = '$ID')";
$result = mysqli_query($conn, $team);

if (!$result) {
    die('Error executing query: ' . mysqli_error($conn));
}
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/Pacifico.css">
    <link rel="stylesheet" href="./css/teaminfo.css">

    <title>Team Members</title>
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

    <main class="Tinfo">
        <section class="table_header">
            <h1>Team informatin</h1>
        </section>
        <section class="table_body">
            <table style="width:100%">
                <tr>
                    <th style="width:30%">Partners Name</th>
                    <th style="width:30%">ID</th>
                    <th style="width:30%">Email</th>
                </tr>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row['First_Name']) . ' ' . htmlspecialchars($row['Second_Name']) . ' ' . htmlspecialchars($row['Last_Name']) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['Student_ID']) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['Email']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </main>
</body>

</html>