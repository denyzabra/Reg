<?php
include('config.php'); // include DB configuration and connection
include('model/dropdowns.php'); // include loading dropdown field data from DB

if(isset($_REQUEST['staff_id'])) {        // check if a staff ID is passed in the request
  $staff_id = $_REQUEST['staff_id'];
  if (is_numeric($staff_id)) {$staff_id = (int)intval($staff_id); // check if the staff ID passed is numeric and convert to PHP integer type
  }
  else $staff_id = intval('0');
}
else {
  $staff_id = intval('0');
  $no_staff_id = 1;
}

if (empty($_POST['admin'])) $_POST['admin'] = 0;

// check if this is a new record and if the form has been fully completed and submitted
if (isset($no_staff_id) && isset($_POST['submit']) && !empty($_POST['f_name']) && !empty($_POST['l_name']) && !empty($_POST['email']) && !empty($_POST['password']) ) {
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);

$sql = "INSERT INTO staff (f_name,l_name,email,password, admin) VALUES (?,?,?,?,?) ";
$ssel_stmt = $conn->prepare($sql);
//echo $conn->error;
$ssel_stmt->bind_param("ssssi",
$_POST['f_name'],
$_POST['l_name'],
$_POST['email'],
$password,
$_POST['admin']);
$insert_success = $ssel_stmt->execute();
if ($insert_success >0) $staff_id=$conn->insert_id; // get newly inserted staff_id
else $insert_failed=1;
  }

elseif (isset($no_staff_id) && isset($_POST['submit']) && (empty($_POST['f_name']) || empty($_POST['l_name']) || empty($_POST['email']) || empty($_POST['password']) ) ) {

$insert_failed='1';
}

elseif(!isset($no_staff_id) && isset($_POST['submit']) && !empty($_POST['f_name']) && !empty($_POST['l_name']) && !empty($_POST['email']) )   { // if there is a staff_id submitted and the form has been submitted with all of the fields submitted (password optional)

$sql = "SELECT * FROM staff WHERE staff_id = ? ";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("i", $staff_id);
$ssel_stmt->execute();
$ssel_result = $ssel_stmt->get_result();

  if ($ssel_result->num_rows < 1) { // the staff ID does not exist
    $staff_id = intval('0');
    }
  else { // the staff ID exists in the DB, update the info

$sql = "UPDATE staff SET f_name=?,l_name=?,email=?,admin=? WHERE staff_id=?";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("sssii",
$_POST['f_name'],
$_POST['l_name'],
$_POST['email'],
$_POST['admin'],
$staff_id);
if($ssel_stmt->execute()) {
  $update_success=1;


  if(!empty($_POST['password'])) {
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
$sql = "UPDATE staff SET password=? WHERE staff_id=?";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("si",
$password,
$staff_id);

  if($ssel_stmt->execute()) { // execute the password update in the DB
    $password_update_success=1;
    } // end if the password was updated successfully in the DB
  } // end if a password was enterd in the POST
} // end if the record was updated successfully

else { // if the update failed
  $update_failed = 1;

  } // end if the update failed


  } // end if the staff ID exists in the DB

} // end if a staff ID exists and the form has been submitted


// check the database to see if the requested staff ID exists

$sql = "SELECT * FROM staff WHERE staff_id = ? ";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("i", $staff_id);
$ssel_stmt->execute();
$ssel_result = $ssel_stmt->get_result();

if ($ssel_result->num_rows < 1) { // the staff ID does not exist
  $staff_id = intval('0');
  $sql = 'SHOW COLUMNS FROM staff'; // get the fields from the staff table to create a blank array to avoid errors on the form
  $res = $conn->query($sql);
  while($row = $res->fetch_assoc()){
    $staff[$row['Field']] = '';
    }
  }
else { // the staff ID exists in the DB, get info
  if (isset($update_failed))  { //if the update failed show fields from the original POST
      $staff=$_POST;
      $staff['staff_id'] = $staff_id;
    }
  else $staff = $ssel_result->fetch_assoc();
  }

if(isset($insert_failed)) { //if the insert failed show fields from the original POST
  $staff=$_POST;
  $staff['staff_id'] = $staff_id;
  }
?>