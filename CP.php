<?php

include './form.php';
include './inc/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/CP.css">
  <link rel="stylesheet" href="./css/Pacifico.css">


  <title>Create Project</title>

</head>

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

<body>

  <div class="container">
    <form action="<?php $_SERVER['REQUEST_METHOD'] ?>" method="POST">

      <h4>project information</h4><br>
      <div class="title" id="1">
        <input type="text" name="title1" id="2" placeholder="Title"><br>
        <span class="title1Erro">
          <?php echo $errors['title1Erro'] ?>
        </span>
      </div>
      <div class="date" id="1">
        <label> Starting time :</label>
        <input class="Starting_time" type="date" name="startdate" id="2" placeholder="starting time">
        <br>
        <label>Finishing time:</label>
        <input class="Finishing_time" type="date" name="enddate" id="3" placeholder="finishing time">
        <span class="startdatErro">
          <?php echo $errors['startdatErro'] ?>
        </span>
        <span class="enddateErro">
          <?php echo $errors['enddateErro'] ?>
        </span>
      </div><br>

      <h4>Team members</h4>
      <div class="member" id="">
        <input class="member1" name="member1" id="2" placeholder="The first member ID">
        <input class="member2" name="member2" id="3" placeholder="The second member ID">
        <input class="member3" name="member3" id="4" placeholder="The third member ID">
        <input class="member4" name="member4" id="5" placeholder="The fourth member ID">
        <br><span class="memberError">
          <?php echo $errors['memberError'] ?>
        </span>
      </div><br>

      <div class="Crea">
        <button class="button" name="Create">Create project</button>
      </div>
    </form>
  </div>

</body>

</html>