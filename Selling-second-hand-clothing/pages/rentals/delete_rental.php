<?php 
  // session_start();
  require("../conn.php");

  $rental_detail_id   = $_POST['rental_detail_id'];

  $sql = "DELETE FROM `rental_details` WHERE `rental_detail_id`='".$rental_detail_id."'";

  if($conn->query($sql)){
    echo "success";
  }else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
?>