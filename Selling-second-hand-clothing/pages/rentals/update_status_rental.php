<?php 
  // session_start();
  require("../conn.php");



  $rental_id   = $_GET['id'];
  $status      = $_GET['status'];
  $tracking_status  = ($_GET['tracking_status'] != '') ? $_GET['tracking_status'] : null;


  if($status == 'ได้รับสินค้าคืนเรียบร้อย'){
    $sql = "UPDATE `rentals` SET `status`='".$status."' WHERE `rental_id`='". $rental_id."'";
  }else{
    $sql = "UPDATE `rentals` SET `status`='".$status."', `tracking_status`='".$tracking_status."' WHERE `rental_id`='". $rental_id."'";
  }
  

  if ($conn->query($sql)) {
    echo "<script>
    alert('อัพเดท ข้อมูลเรียบร้อย');
    window.location.href='list_rental_admin.php';
    </script>";
  }else{
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
?>