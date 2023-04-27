<?php

// load dropdown field data from the DB

// gender
$sql = "SELECT * FROM gender";
$sel_stmt = $conn->prepare($sql);
$sel_stmt->execute();
$sel_result = $sel_stmt->get_result();
$gender_dd = array();
$dd_count = $sel_result->num_rows;
$i = 0;
if ($dd_count > 0) { // if there are entries in the gender table
   while ($dd = $sel_result->fetch_assoc() ) {
      $gender_dd[$i]= $dd;
     $i++;
  }
}

// marital_status
$sql = "SELECT * FROM marital_status";
$sel_stmt = $conn->prepare($sql);
$sel_stmt->execute();
$sel_result = $sel_stmt->get_result();
$marital_status_dd = array();
$dd_count = $sel_result->num_rows;
$i = 0;
if ($dd_count > 0) { // if there are entries in the marital_status table
   while ($dd = $sel_result->fetch_assoc() ) {
      $marital_status_dd[$i]= $dd;
     $i++;
  }
}


// staff
$sql = "SELECT * FROM staff ORDER BY l_name, f_name";
$sel_stmt = $conn->prepare($sql);
$sel_stmt->execute();
$sel_result = $sel_stmt->get_result();
$staff_dd = array();
$dd_count = $sel_result->num_rows;
$i = 0;
if ($dd_count > 0) { // if there are entries in the marital_status table
   while ($dd = $sel_result->fetch_assoc() ) {
      $staff_dd[$i]= $dd;
     $i++;
  }
}


?>