<?php
if(isset($_POST['Logout'])){
unset($ID_Student);
unset($ID_Supervisor);
header('Refresh:1; url=landingpage.php');
}
?>