<?php
include './inc/database.php';
include './inc/Slogin.php';
session_start();
$SID = $_SESSION['ID_Supervisor'];



$tinfo = "SELECT * from person INNER JOIN supervisor ON SSN = SP_SSN where Supervisor_ID = '$SID'";

$result = mysqli_query($conn, $tinfo);

if (!$result) {
    die('Error executing query: ' . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/Pacifico.css">
    <link rel="stylesheet" href="./css/tinfopage.css">

    <title>Home Page</title>
</head>

<body>
    <header>
        <div class="mark">
            project <img src="./images/gradcapblue.png" alt="gradcap"> partner
        </div>

        <nav class="navigation">
            <a href="http://localhost/projectpartner/superhomepage.php">Home</a>
            <a href="http://localhost/projectpartner/cp.php">Create project</a>
            <a href="#">Create team</a>
            <a href="#">Projects</a>
            <button onclick="window.location.href='//localhost/projectpartner/landingpage.php'" class="btnlogout">Log
                out</button>
        </nav>
    </header>

    <main class="Tinfo">
        <section class="table_header">
            <h1>My informatin</h1>
        </section>
        <section class="table_body">
            <table style="width:100%">
                <tr>
                    <th style="width:30%">ID</th>
                    <td>
                        <?php echo htmlspecialchars($row['Supervisor_ID']) ?>
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
                        <?php echo htmlspecialchars($row['SP_SSN']) ?>
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