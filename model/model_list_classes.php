<?php

include('config.php'); // include DB configuration and connection
include('model/program_checkboxes.php'); // include DB configuration and connection


if (!empty($_POST['new_session'])) {

$sql = "INSERT INTO sessions (term_id, class_id, session_name) VALUES (?,?,?) ";
$ssel_stmt = $conn->prepare($sql);
//echo $conn->error;
$ssel_stmt->bind_param("iis",

$_POST['term_id'],
$_POST['class_id'],
$_POST['session_name']);

$ssel_stmt->execute();

$session_id=$conn->insert_id; // get newly inserted student_id

$sql = "INSERT INTO staff2sessions (session_id, staff_id) VALUES (?,?) ";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("ii",
$session_id,
$_POST['staff_id']);

$ssel_stmt->execute();

}



$terms = array();
$programs = array();
$classes = array();
$sessions = array();

$attendance_date = date('Y-m-d',$_SESSION['attendance_date']);
$full_date = date('l, F j, Y',$_SESSION['attendance_date']);

//TERMS section

if (!empty($_REQUEST['term_id'])) {        // check if a term ID is passed in the request
  $term_id = $_REQUEST['term_id'];
  if (is_numeric($term_id)) $term_id = (int)intval($term_id); // check if the term ID passed is numeric and convert to PHP integer type
  else $term_id = intval('0');
}
else {
  $term_id = intval('0');
}

if ($term_id<1) {
    $sql = "SELECT * from terms";
    $ssel_stmt = $conn->prepare($sql);
    //$ssel_stmt->bind_param("ssi", $attendance_date, $attendance_date, $_SESSION['staff_id']);
    $ssel_stmt->execute();
    $ssel_result = $ssel_stmt->get_result();
    
    $count = $ssel_result->num_rows;
    $i = 0;
    if ($count > 0) { // if there are entries in the terms table
       while ($record = $ssel_result->fetch_assoc() ) {
          $terms[$i]= $record;
         $i++;
      }
    }
  }
else { // a term id has been supplied
      $sql = "SELECT * from terms WHERE term_id = ?";
    $ssel_stmt = $conn->prepare($sql);
    $ssel_stmt->bind_param("i", $term_id);
    $ssel_stmt->execute();
    $ssel_result = $ssel_stmt->get_result();
    $term_selected = $ssel_result->fetch_assoc();
}


//SESSIONS section

if (!empty($_REQUEST['session_id'])) {        // check if a session ID is passed in the request
  $session_id = $_REQUEST['session_id'];
  if (is_numeric($session_id)) $session_id = (int)intval($session_id); // check if the session ID passed is numeric and convert to PHP integer type
  else $session_id = intval('0');
}
else {
  $session_id = intval('0');
}


if (!empty($_POST['delete_session'])) {

$sql = "DELETE FROM sessions WHERE session_id = ? ";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("i",

$_POST['session_id']);

$ssel_stmt->execute();

$sql = "DELETE FROM staff2sessions WHERE session_id = ? ";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("i",

$_POST['session_id']);

$ssel_stmt->execute();

  $session_id = intval('0');
}




if ($term_id>0 && $session_id<1) { // no session has been selected
    $sql = "
SELECT * from sessions
JOIN classes ON sessions.class_id = classes.class_id
JOIN programs ON classes.program_id = programs.program_id
WHERE term_id = ?
ORDER BY programs.program_name, classes.class_name, sessions.session_name";
    $ssel_stmt = $conn->prepare($sql);
    $ssel_stmt->bind_param("i", $term_id);
    $ssel_stmt->execute();
    $ssel_result = $ssel_stmt->get_result();
    
    $count = $ssel_result->num_rows;
    $i = 0;
    if ($count > 0) { // if there are entries in the terms table
       while ($record = $ssel_result->fetch_assoc() ) {
          $sessions[$i]= $record;
         $i++;
      }
    }
  }
  
else { // a session id has been supplied
      $sql = "
      SELECT * from sessions
JOIN classes ON sessions.class_id = classes.class_id
JOIN programs ON classes.program_id = programs.program_id
WHERE session_id = ?
      ";
    $ssel_stmt = $conn->prepare($sql);
    $ssel_stmt->bind_param("i", $session_id);
    $ssel_stmt->execute();
    $ssel_result = $ssel_stmt->get_result();
    $session_selected = $ssel_result->fetch_assoc();
}

  
?>