<?php

require('../conn.php');


$sql = "DELETE FROM `Favorites` WHERE `product_id` = '".$_GET['id']."' AND `member_id` = '".$_SESSION["id"]."'";
$result = $conn->query($sql);

if ($result === true) {
  echo "
    <script>
      alert('ลบรายการโปรดเรียบร้อย')
      window.history.back();
    </script>
  ";
}else{
  echo "
    <script>
      alert('ลบข้อมูลไม่สำเร็จ กรุณาลองอีกครั้ง')
      window.history.back();
    </script>
  ";
}



?>