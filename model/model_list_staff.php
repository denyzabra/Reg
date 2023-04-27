<?php

include('config.php'); // include DB configuration and connection

$sql = "SELECT * FROM staff ORDER BY l_name, f_name";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->execute();
$ssel_result = $ssel_stmt->get_result();
$staff_list = array();
$staff_count = $ssel_result->num_rows;
$i = 0;
if ($staff_count > 0) { // if there are entries in the staff table
   while ($dd = $ssel_result->fetch_assoc() ) {
      $staff_list[$i]= $dd;
     $i++;
  }
}

?>