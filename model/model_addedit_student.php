<?php

include('config.php'); // include DB configuration and connection
include('model/dropdowns.php'); // include loading r$dropdown field data from DB
include('model/program_checkboxes.php'); // include loading dropdown field data from DB


if(isset($_REQUEST['student_id'])) {        // check if a student ID is passed in the request
  $student_id = $_REQUEST['student_id'];
  if (is_numeric($student_id)) {$student_id = (int)intval($student_id); // check if the student ID passed is numeric and convert to PHP integer type
  }
  else $student_id = intval('0');
}
else {
  $student_id = intval('0');
  $no_student_id = 1;
}


// check if this is a new record and if the form has been submitted
if (isset($no_student_id) && isset($_POST['submit'])) {

if (!isset($_POST['dob']) || $_POST['dob']=='' ) $_POST['dob']=NULL; // if DOB doesn't exist set it to NULL to avoid database error
$sql = "INSERT INTO students (entry_year,f_name,l_name,contact,kin_name,kin_contact,dob,age,email,residence,workplace,gender_id,marital_id,children,num_children,health_issues,notes) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
$ssel_stmt = $conn->prepare($sql);
//echo $conn->error;
$ssel_stmt->bind_param("issssssisssiiiiss",
$year,
$_POST['f_name'],
$_POST['l_name'],
$_POST['contact'],
$_POST['kin_name'],
$_POST['kin_contact'],
$_POST['dob'],
$_POST['age'],
$_POST['email'],
$_POST['residence'],
$_POST['workplace'],
$_POST['gender_id'],
$_POST['marital_id'],
$_POST['children'],
$_POST['num_children'],
$_POST['health_issues'],
$_POST['notes']);

$ssel_stmt->execute();

$student_id=$conn->insert_id; // get newly inserted student_id

$sql = "SELECT MAX(student_num) AS student_num FROM students WHERE entry_year = ? "; // find highest student_num for currrent year so we can assign the next highest
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("i", $year);
$ssel_stmt->execute();
$ssel_result = $ssel_stmt->get_result();
$student = $ssel_result->fetch_assoc();
$next_student_num = $student['student_num']+1;
$sql = "UPDATE students SET student_num=? WHERE student_id=?"; // add next highest student_num for current year to most recently inserted record
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("ii",
$next_student_num,
$student_id);
$ssel_stmt->execute();


// $sql = "DELETE FROM students2programs WHERE students2programs.student_id = ? "; // clear all entries from students2programs table for this student
// $ssel_stmt = $conn->prepare($sql);
// $ssel_stmt->bind_param("i", $student_id);
// $ssel_stmt->execute();

  for($i = 0;$i < count($program_checkboxes);$i++) { // loop through programs and add entries to students2programs table
    if(!empty($_POST['program_'.$program_checkboxes[$i]['program_id']])) {
  $sql = "INSERT into students2programs (student_id,program_id) VALUES (?,?) "; // add entry to students2programs table
  $ssel_stmt = $conn->prepare($sql);
  $ssel_stmt->bind_param("ii", $student_id, $program_checkboxes[$i]['program_id']);
  $ssel_stmt->execute();
    }
  }


$insert_success=1;
  }
  
elseif(!isset($no_student_id) && isset($_POST['submit'])) { // if there is a student_id submitted and the form has been submitted then update DB

 
$sql = "SELECT * FROM students WHERE student_id = ? ";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("i", $student_id);
$ssel_stmt->execute();
$ssel_result = $ssel_stmt->get_result();

  if ($ssel_result->num_rows < 1) { // the student ID does not exist
    $student_id = intval('0');
    }
  else { // the student ID exists in the DB, update the info
  
    if (!isset($_POST['dob']) || $_POST['dob']=='' ) $_POST['dob']=NULL; // if DOB doesn't exist set it to NULL to avoid database error
    $sql = "UPDATE students SET f_name=?,l_name=?,contact=?,kin_name=?,kin_contact=?,dob=?,age=?,email=?,residence=?,workplace=?,gender_id=?,marital_id=?,children=?,num_children=?,health_issues=?,notes=? WHERE student_id=?";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("ssssssisssiiiissi",
$_POST['f_name'],
$_POST['l_name'],
$_POST['contact'],
$_POST['kin_name'],
$_POST['kin_contact'],
$_POST['dob'],
$_POST['age'],
$_POST['email'],
$_POST['residence'],
$_POST['workplace'],
$_POST['gender_id'],
$_POST['marital_id'],
$_POST['children'],
$_POST['num_children'],
$_POST['health_issues'],
$_POST['notes'],
$student_id);

if($ssel_stmt->execute()) {
  $update_success=1;
  

  $sql = "DELETE FROM students2programs WHERE students2programs.student_id = ? "; // clear all entries from students2programs table for this student
  $ssel_stmt = $conn->prepare($sql);
  $ssel_stmt->bind_param("i", $student_id);
  $ssel_stmt->execute();

    for($i = 0;$i < count($program_checkboxes);$i++) { // loop through programs and add entries to students2programs table
      if(!empty($_POST['program_'.$program_checkboxes[$i]['program_id']])) {
    $sql = "INSERT into students2programs (student_id,program_id) VALUES (?,?) "; // add entry to students2programs table
    $ssel_stmt = $conn->prepare($sql);
    $ssel_stmt->bind_param("ii", $student_id, $program_checkboxes[$i]['program_id']);
    $ssel_stmt->execute();
      }
    }
  }
  
else {
  $update_failed = 1;

  }


  }

}

// file upload for photo

if ($student_id>0 && !empty($_FILES["photo"]["name"])) {


$file_name = basename($_FILES["photo"]["name"]);
$target_file_path = $root_path . $upload_folder . $file_name;
$file_type = pathinfo($target_file_path,PATHINFO_EXTENSION);
$new_file_name = $student_id . '.jpg';

$allow_types = array('jpg','JPG','png','PNG','jpeg','JPEG','gif','GIF');
    if(in_array($file_type, $allow_types)){
        // Upload file to server
        if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file_path)){
          
          //rotate image to correct orientation
 //          $filename = "/files/1.jpg"; /*ADD YOUR FILENAME WITH PATH*/
            $exif = exif_read_data($target_file_path);
              $ort = $exif['Orientation']; /*STORES ORIENTATION FROM IMAGE */
              $ort1 = $ort;
              $exif = exif_read_data($target_file_path, 0, true);
                if (!empty($ort1))
               {
                 $image = imagecreatefromjpeg($target_file_path);
                 $ort = $ort1;
                    switch ($ort) {
                          case 3:
                              $image = imagerotate($image, 180, 0);
                              break;
          
                          case 6:
                              $image = imagerotate($image, -90, 0);
                              break;
          
                          case 8:
                              $image = imagerotate($image, 90, 0);
                              break;
                      }
                  }
                 imagejpeg($image,$target_file_path, 90); /*IF FOUND ORIENTATION THEN ROTATE IMAGE IN PERFECT DIMENSION*/
                    
          
          // resize uploaded image
          $max_dim = 800; //maximum height or width for photo in pixels
          list($width, $height, $type, $attr) = getimagesize( $target_file_path );
          if ( $width > $max_dim || $height > $max_dim ) {
            $ratio = $width/$height;
            if( $ratio > 1) {
              $new_width = $max_dim;
              $new_height = $max_dim/$ratio;
            } else {
            $new_width = $max_dim*$ratio;
            $new_height = $max_dim;
            }
          $src = imagecreatefromstring( file_get_contents( $target_file_path ) );
          $dst = imagecreatetruecolor( $new_width, $new_height );
          imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
          imagedestroy( $src );
          imagejpeg( $dst, $root_path . $photos_folder . $new_file_name ); // adjust format as needed
          imagedestroy( $dst );
        }
          
          
          
          
          
          
            // Insert image file name into database

            $sql = "UPDATE students SET photo=? WHERE student_id=?";
            $ssel_stmt = $conn->prepare($sql);
            $ssel_stmt->bind_param("si",$new_file_name,$student_id);
            $insert = $ssel_stmt->execute();

            if($insert){
                $photo_success = "The file ".$file_name. " has been uploaded successfully.";
            }else{
                $photo_err = "File upload failed, please try again.";
            }
        }else{
            $photo_err = "Sorry, there was an error uploading your file.";
        }
    }else{
        $photo_err = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
    }
}



// check the database to see if the requested student ID exists

$sql = "SELECT * FROM students WHERE student_id = ? ";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("i", $student_id);
$ssel_stmt->execute();
$ssel_result = $ssel_stmt->get_result();

if ($ssel_result->num_rows < 1) { // the student ID does not exist
  $student_id = intval('0');
  $sql = 'SHOW COLUMNS FROM students'; // get the fields from the students table to create a blank array to avoid errors on the form
  $res = $conn->query($sql);
  while($row = $res->fetch_assoc()){
    $student[$row['Field']] = '';
    }
  }
else { // the student ID exists in the DB, get info
  if (isset($update_failed))  {
    $student=$_POST;
    $db_student = $ssel_result->fetch_assoc();
    $student['photo']=$db_student['photo'];
    }
  else { // db record found
    $student = $ssel_result->fetch_assoc(); // place information into $student array
    $sql = "SELECT * FROM students2programs WHERE student_id = ? "; // get information from students2programs table
    $s2p_stmt = $conn->prepare($sql);
    $s2p_stmt->bind_param("i", $student_id);
    $s2p_stmt->execute();
    $s2p_result = $s2p_stmt->get_result();
    $students2programs = array();
    $s2p_count = $s2p_result->num_rows;
    $i = 0;
     if ($s2p_count > 0) { // if there are entries in the students2programs table for the selected student
        while ($s2p = $s2p_result->fetch_assoc() ) {
        $student['program_'.$s2p['program_id']] = 1;
        $i++;
        }
      }
    } // end if the student ID exists in the DB
  
  
  
  }
  
  
?>