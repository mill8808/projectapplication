<?php
require("../conn.php");


$rental_id = $_GET['id'];


$update = "UPDATE `rentals` SET `status`='ยกเลิกคำสั่งซื้อ' WHERE `rental_id`='".$rental_id."' ";

if ($conn->query($update) === TRUE) { //เช็คว่าสามารถบันทึกข้อมูลได้ไหม
	echo "
        <script>
          alert('ยกเลิกรายการเรียบร้อย')
          window.location.href = '/$projectname/'
        </script>
      ";
}else{
	echo "Error: " . $insert . "<br>" . $conn->error;
}




?>