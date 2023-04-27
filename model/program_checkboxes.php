<?php

// load program checkboxes data from the DB

$sql = "SELECT * FROM programs";
$sel_stmt = $conn->prepare($sql);
$sel_stmt->execute();
$sel_result = $sel_stmt->get_result();
$program_checkboxes = array();
$p_count = $sel_result->num_rows;
$i = 0;
if ($p_count > 0) { // if there are entries in the programs table
   while ($p = $sel_result->fetch_assoc() ) {
      $program_checkboxes[$i]= $p;
     $i++;
  }
}



?>