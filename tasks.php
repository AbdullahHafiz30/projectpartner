<?php

include './inc/database.php';
session_start();
$ID = $_SESSION['ID_Student'];

$tasks = "SELECT * from tasks where Project_ID = (SELECT Project_ID from project where Team_ID = (SELECT Team_ID from student where Student_ID = '$ID'))";
$result = mysqli_query($conn, $tasks);

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
    <link rel="stylesheet" href="./css/tasks.css">
    <link rel="stylesheet" href="./js/tasks.js">

    <title>Project Tasks</title>
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
            <h1> Tasks </h1>
        </section>
        <section class="table_body">
            <table style="width:100%">
                <tbody>
                    <table>
                        <thead>
                            <tr>
                                <th style="width:20%">Task ID</th>
                                <th style="width:20%">Task Title</th>
                                <th style="width:20%">Priority</th>
                                <th style="width:20%">Due date</th>
                                <th style="width:20%">Project ID</th>
                                <th style="width:10%">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <td>
                                        <?php echo htmlspecialchars($row['Task_ID']) ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($row['Title']) ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($row['priority']) ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($row['due_date']) ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($row['Project_ID']) ?>
                                    </td>
                                    <td><input type="checkbox"></td>
                                </tr>
                            <?php endforeach; ?>
                    </table>
                </tbody>

            </table>
            <div class="buttons">
                <button class="add-task" >Add Task</button>
                <button class="delete-task">Delete Task</button>
            </div>


            </tbody>
        </section>
    </main>
</body>

</html>