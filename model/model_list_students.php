<?php

include('config.php'); // include DB configuration and connection

$sql = "SELECT * FROM students ORDER BY l_name, f_name";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->execute();
$ssel_result = $ssel_stmt->get_result();
$student_list = array();
$student_count = $ssel_result->num_rows;
$i = 0;
if ($student_count > 0) { // if there are entries in the students table
   while ($dd = $ssel_result->fetch_assoc() ) {
      $student_list[$i]= $dd;
     $i++;
  }
}

?>