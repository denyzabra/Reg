<?php

$servername = "localhost";
$username = "communit_cofireg";
$password = "Ug@nda123!!";
$dbname = "communit_cofireg";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully<br>";


//PATHS
$root_path = "/home/communit/reg/";
$upload_folder = "uploads/";
$photos_folder = "photos/";

//CONSTANTS
$student_num_prefix = "CF";
$year = date("Y");


//FUNCTIONS

function pr($array_name) { // print array (for development use) {
echo "<pre>";
print_r($array_name);
echo "</pre>";
}

?>