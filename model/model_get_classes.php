<?php

include_once('config.php'); // include DB configuration and connection


// Read POST data
$post_data = json_decode(file_get_contents("php://input"));
$request = "";
if(isset($post_data->request)){
   $request = $post_data->request;
}

if(isset($post_data->program_id)){
       $program_id = $post_data->program_id;

$sql = "SELECT * from classes WHERE program_id = ?";
$ssel_stmt = $conn->prepare($sql);
$ssel_stmt->bind_param("i", $program_id);
$ssel_stmt->execute();
$ssel_result = $ssel_stmt->get_result();

      while ($row = $ssel_result->fetch_assoc()){

         $id = $row['class_id'];
         $name = $row['class_name'];

         $data[] = array(
            "id" => $id,
            "name" => $name
         );

      }

   echo json_encode($data);
   die;
}
?>