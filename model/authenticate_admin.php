<?php

   if (empty($_SESSION['admin']) ) {
  //not admin user, redirect to dashboard.php page
  
     header("Location: dashboard.php");

     exit();

   }
?>