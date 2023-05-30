<?php
include './inc/database.php';
session_start();
$SID = $_SESSION['ID_Supervisor'];



$errors = [
  'title1Erro' => '',
  'startdatErro' => '',
  'enddateErro' => '',
  'memberError' => ''
];

if (isset($_POST['Create'])) {

  $title1 = strip_tags($_POST['title1']);
  $startdate = strip_tags($_POST['startdate']);
  $enddate = strip_tags($_POST['enddate']);
  $M1 = strip_tags($_POST['member1']);
  $M2 = strip_tags($_POST['member2']);
  $M3 = strip_tags($_POST['member3']);
  $M4 = strip_tags($_POST['member4']);
  $ID_Team = strip_tags(mt_rand(1, 10000));
  $Project_ID = strip_tags(mt_rand(1, 10000));

  if (empty($title1)) {
    $errors['title1Erro'] = "Please enter a title";
  } elseif (empty($startdate)) {
    $errors['startdatErro'] = "Please enter a start date";
  } elseif (empty($enddate)) {
    $errors['enddateErro'] = "Please enter an end date";
  } elseif ($M1 === $M2 || $M1 === $M3 || $M1 === $M4 || $M2 === $M3 || $M2 === $M4 || $M3 === $M4) {
    $errors['memberError'] = "Team members must have different IDs";
  } else {

    // Insert a new team
    $sql6 = "INSERT INTO team(Team_ID,Supervisor_ID) VALUES ('$ID_Team', $SID)";
    mysqli_query($conn, $sql6);

    // Insert a new project
    $sql = "INSERT INTO project(Project_ID, Title, Start_date, End_date, Supervisor_ID, Team_ID) VALUES
     ('$Project_ID','$title1','$startdate','$enddate','$SID','$ID_Team')";
    mysqli_query($conn, $sql);

    // Update the students' team IDs
    $sql1 = "UPDATE student SET Team_ID='$ID_Team' WHERE Student_ID='$M1'";
    mysqli_query($conn, $sql1);
    $sql2 = "UPDATE student SET Team_ID='$ID_Team' WHERE Student_ID='$M2'";
    mysqli_query($conn, $sql2);
    $sql3 = "UPDATE student SET Team_ID='$ID_Team' WHERE Student_ID='$M3'";
    mysqli_query($conn, $sql3);
    $sql4 = "UPDATE student SET Team_ID='$ID_Team' WHERE Student_ID='$M4'";
    mysqli_query($conn, $sql4);

    echo "<h1>Project created successfully!</h1>";
  }
}

mysqli_close($conn);

?>