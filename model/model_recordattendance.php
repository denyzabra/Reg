<?php

include('config.php'); // include DB configuration and connection

$attendance_date = date('Y-m-d',$_SESSION['attendance_date']);
$sql = "SELECT * from attendance WHERE (session_id = ? AND student_id = ? AND attendance_date = ?)";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("iis", $_REQUEST['session_id'],$_REQUEST['student_id'],$attendance_date);
$ssel_stmt->execute();
$ssel_result = $ssel_stmt->get_result();
$attendance_count = $ssel_result->num_rows;
if ($attendance_count > 0) { // an attendance record exists for this student for this date, so delete it
  $sql = "DELETE FROM attendance WHERE (session_id = ? AND student_id = ? AND attendance_date = ?)";
  $ssel_stmt = $conn->prepare($sql);
  $ssel_stmt->bind_param("iis", $_REQUEST['session_id'],$_REQUEST['student_id'],$attendance_date);
  $ssel_stmt->execute();
  $attended = 0;
  
  }
  else { // no attendance record exists for this student for this date, so create one
  
  $sql = "INSERT INTO attendance (session_id, student_id, attendance_date) VALUES (?,?,?)";
  $ssel_stmt = $conn->prepare($sql);
  $ssel_stmt->bind_param("iis",$_REQUEST['session_id'],$_REQUEST['student_id'],$attendance_date);
  $ssel_stmt->execute();
  $attended = 1;

}
?>