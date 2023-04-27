<?php

   ob_start();
   session_start();
   
   if (isset($_SESSION['staff_id']) && isset($_SESSION['email'])) {
  //logged in, redirect to dashboard.php page
  
     header("Location: dashboard.php");

     exit();
     
   }
   
include('config.php'); // include DB configuration and connection

// check if the form has been fully completed and submitted
if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password']) ) {


$sql = "SELECT * FROM staff WHERE email = ? ";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("s", $_POST['email']);
$ssel_stmt->execute();
$ssel_result = $ssel_stmt->get_result();

  if ($ssel_result->num_rows < 1) { // the email  does not exist
  $email_error = 1;
  }
  else { // the email address was found in the staff table
    $login_details = $ssel_result->fetch_assoc();
    if(password_verify($_POST['password'],$login_details['password'])) {
      // login correct, redirect here
      
                $_SESSION['email'] = $login_details['email'];

                $_SESSION['f_name'] = $login_details['f_name'];

                $_SESSION['l_name'] = $login_details['l_name'];
                
                $_SESSION['staff_id'] = $login_details['staff_id'];
                
                $_SESSION['admin'] = $login_details['admin'];
                
                $_SESSION['attendance_date'] = time();

                header("Location: dashboard.php");

                exit();
    }
    else $login_failed=1;
  }

} // end if the form was submitted all fields completed

$login = $_POST;
?>