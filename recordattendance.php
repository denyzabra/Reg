<?php
include('model/authenticate.php'); // load authentication script to validate user is logged in
include('model/model_recordattendance.php'); // load and/or process DB data for Recording attendance

if ($attended == 1) echo "<div style='background-color:green;color:white;font-weight:bold;text-align:center;border-radius:5%' onclick='record_attendance(" . $_REQUEST['session_id'] . "," . $_REQUEST['student_id'] . ")'>Present</div>";
if ($attended == 0) echo "<div style='background-color:red;color:white;font-weight:bold;text-align:center;border-radius:5%' onclick='record_attendance(" . $_REQUEST['session_id'] . "," . $_REQUEST['student_id'] . ")'>Absent</div>";
?>