<?php

include './inc/database.php';
session_start();
$ID = $_SESSION['ID_Student'];


?>

<!DOCTYPE html>
<html>

<head>
  <title>Project Files</title>
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/Pacifico.css">

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

  <div class="center">
    <div class="container">
      <h2>Uploaded Files</h2>
      <table>
        <tr>
          <th>File Name</th>
          <th>Upload Time</th>
          <th>Size (KB)</th>
          <th>Actions</th>
        </tr>
        <?php
        include_once './inc/database.php';
        $sql = "SELECT * from file where Project_ID = (SELECT Project_ID from project where Team_id = (SELECT Team_id from student where Student_ID = '$ID'))";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td>
              <?php echo $row['file_name']; ?>
            </td>
            <td>
              <?php echo $row['uploaded_time']; ?>
            </td>
            <td>
              <?php echo $row['size']; ?>
            </td>
            <td>
              <a class="button" href="download.php?file_id=<?php echo $row['id']; ?>">Download</a>
              <a class="button" href="delete.php?file_id=<?php echo $row['id']; ?>">Delete</a>
            </td>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>

    <div class="container">
      <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" />
        <button type="submit" name="upload" class="ub">Upload</button>
      </form>
    </div>
  </div>

</body>

</html>