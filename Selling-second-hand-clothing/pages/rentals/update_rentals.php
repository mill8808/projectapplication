<?php 
  // session_start();
  require("../conn.php");

  $rental_detail_id   = $_POST['rental_detail_id'];
  $total              = $_POST['total'];

  $sql = "UPDATE `rental_details` SET `total`='".$total."' WHERE `rental_detail_id`='".$rental_detail_id."'";

  if($conn->query($sql)){
    echo "success";
  }else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
?>