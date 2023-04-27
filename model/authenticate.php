<?php

   ob_start();
   session_start();
   
   if (!isset($_SESSION['staff_id']) || !isset($_SESSION['email'])) {
  //not logged in, redirect to login.php page
  
     header("Location: login.php");

     exit();

   }
?>