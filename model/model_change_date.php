<?php

include('config.php'); // include DB configuration and connection

if (!empty($_POST['new_date']) ) {
  $_SESSION['attendance_date'] = strtotime($_POST['new_date']);
  
                header("Location: attendance.php");

                exit();
  
}

$current_date = date('Y-m-d',$_SESSION['attendance_date']);
$full_date = date('l, F j, Y',$_SESSION['attendance_date']);

?>