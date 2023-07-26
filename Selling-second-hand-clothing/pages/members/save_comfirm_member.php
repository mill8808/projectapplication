<?php

require('../conn.php');


$membe_id   = $_GET['id'];
$status     = $_GET['status'];

$sql = "UPDATE `members` SET `status`='".$status."' WHERE `membe_id`= '".$membe_id."'";
$result = $conn->query($sql);


$members = $conn->query("SELECT * FROM `members` WHERE `membe_id` = '".$membe_id."'");
$member  = $members->fetch_array();
$member_email = $member['member_email'];

if ($result === true) {
    echo "
      <script>
        window.location.href = 'sentmail_confirm.php?email=$member_email&status=$status'
      </script>
    ";
}else{
  echo "
    <script>
      alert('บันทึกข้อมูลไม่สำเร็จ กรุณาลองอีกครั้ง')
      window.location.href = 'list_members.php'
    </script>
  ";
}



?>