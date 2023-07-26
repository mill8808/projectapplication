<?php
include('../conn.php');

if (!isset($_SESSION['id'])) {
echo "<script>
    alert('กรุณาเข้าสู่ระบบ');
    window.location.href='/$projectname/index.php';
    </script>";
}else{

	$product_id = $_GET['id'];
	$path 		= "/".$projectname."/".$_GET['path'].".php";
	$member_id	= $_SESSION["id"];

	echo $path;

	$sql = $conn->query("SELECT * FROM `Favorites` WHERE `member_id` = '".$member_id."' AND `product_id` = '".$product_id."'");
	$row_count = $sql->num_rows;
	if ($row_count > 0) {
		echo "
	    <script>
	      alert('บันทึกรายการโปรดเรียบร้อย')
	      window.history.back();
	    </script>
	  ";
	}else{
		$insert = "INSERT INTO `Favorites`(`member_id`, `product_id`) VALUES ('".$member_id."','".$product_id."')";
		$result = $conn->query($insert);

		if ($result === true) {
		  echo "
		    <script>
		      alert('บันทึกรายการโปรดเรียบร้อย')
		      window.history.back();
		    </script>
		  ";
		}else{
		  echo "
		    <script>
		      alert('บันทึกข้อมูลไม่สำเร็จ กรุณาลองอีกครั้ง')
		      window.history.back();
		    </script>
		  ";
		}
	}
}




?>