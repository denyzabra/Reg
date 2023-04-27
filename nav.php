<?php
echo "<a href='dashboard.php'>Dashboard</a>";

$current_page = basename($_SERVER['PHP_SELF']);

//echo $current_page;

if ($current_page == "addedit_staff.php") echo " -> <a href='list_staff.php'>List Staff</a>";
if ($current_page == "addedit_student.php") echo " -> <a href='list_students.php'>List Students</a>";
if ($current_page == "class_attendance.php") echo " -> <a href='attendance.php'>Attendance</a>";
if ($current_page == "change_date.php") echo " -> <a href='attendance.php'>Attendance</a>";
if ($current_page == "list_classes.php") echo " -> <a href='list_classes.php'>Setup Terms & Sessions</a>";

?>