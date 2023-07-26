<?php 
  // session_start();
  require("../conn.php");

  $rental_id              = $_POST['rental_id'];
  $rental_pick_up_date    = $_POST['rental_pick_up_date'];
  $delivery_time          = $_POST['delivery_time'];
  $total_day              = $_POST['total_day']." day";


  // echo $total_day;

  $strStartDate =date('Y-m-d');
  $rental_return_date = date ("Y-m-d", strtotime($total_day, strtotime($rental_pick_up_date)));

  // $rental_return_date     = $_POST['rental_return_date'];

  $sql = "UPDATE `rentals` SET `rental_pick_up_date`='".$rental_pick_up_date."',`rental_return_date`='".$rental_return_date."',`delivery_time`='".$delivery_time."' WHERE `rental_id`='".$rental_id."'";

  if($conn->query($sql)){
    echo "success";
  }else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
?>