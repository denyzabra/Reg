<?php

include('config.php'); // include DB configuration and connection

$attendance_date = date('Y-m-d',$_SESSION['attendance_date']);
$full_date = date('l, F j, Y',$_SESSION['attendance_date']);

$sql = "SELECT s.session_id, s.session_name, p.program_name, c.class_name, t.term_name, t.start_date, t.end_date, st.staff_id FROM `sessions` as s INNER JOIN classes as c on s.class_id = c.class_id INNER JOIN programs as p on p.program_id=c.program_id INNER JOIN terms as t on t.term_id = s.term_id INNER JOIN staff2sessions as st ON st.session_id=s.session_id WHERE s.session_id=? ";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("i", $_REQUEST['session_id']);
$ssel_stmt->execute();
$ssel_result = $ssel_stmt->get_result();

$class_list = array();
$staff_count = $ssel_result->num_rows;
$i = 0;
if ($staff_count > 0) { // if there are entries in the staff table
   while ($dd = $ssel_result->fetch_assoc() ) {
      $class_list[$i]= $dd;
     $i++;
  }
}


$sql = "SELECT s.student_id, s.f_name, s.l_name, s.contact, s.email, s.photo, s2s.session_id, a.attendance_date FROM students as s
INNER JOIN students2sessions AS s2s ON s.student_id=s2s.student_id
LEFT JOIN attendance AS a ON (s.student_id=a.student_id AND s2s.session_id=a.session_id AND a.attendance_date=?)
WHERE s2s.session_id=?
ORDER BY s.l_name, s.f_name";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("si", $attendance_date,$_REQUEST['session_id']);
$ssel_stmt->execute();
$ssel_result = $ssel_stmt->get_result();
$student_list = array();
//echo $ssel_result->num_rows;
$student_count = $ssel_result->num_rows;
$i = 0;
if ($student_count > 0) { // if there are entries in the students table
   while ($dd = $ssel_result->fetch_assoc() ) {
      $student_list[$i]= $dd;
     $i++;
  }
}

?>