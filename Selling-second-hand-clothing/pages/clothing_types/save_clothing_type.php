<?php
include('../conn.php');

$clothingtype_id               = $_POST['clothingtype_id'];
$clothingtype_name         		= $_POST['clothingtype_name'];



if ($clothingtype_id != "") {
	$sql = "SELECT * FROM `clothing_type` WHERE `clothingtype_name` = '".$clothingtype_name."' AND clothingtype_id != '".$clothingtype_id."'";
	$result = $conn->query($sql);
	

	if ($result !== false && $result->num_rows > 0){
		echo "
          <script>
            alert('พบข้อมูลซ้ำ กรุณาลองอีกครั้ง')
            window.location.href = 'form_clothing_type.php?id=$clothingtype_id'
          </script>
        ";
		
	}else{
		$update = "UPDATE `clothing_type` SET   `clothingtype_name`			='".$clothingtype_name."'
								  						WHERE `clothingtype_id`				='".$clothingtype_id."'";
		$result = $conn->query($update);

	    if ($result === true) {
	      echo "
	        <script>
	          alert('แก้ไขข้อมูลเรียบร้อย')
	          window.location.href = 'list_clothing_types.php'
	        </script>
	      ";
	    }else{
	      echo "
	        <script>
	          alert('แก้ไขข้อมูลไม่สำเร็จ กรุณาลองอีกครั้ง')
	          window.location.href = 'form_clothing_type.php?id=$clothingtype_id'
	        </script>
	      ";
	    }				
	}

}else{
	$sql = "SELECT * FROM `clothing_type` WHERE `clothingtype_name` = '".$clothingtype_name."'";
	$result = $conn->query($sql);
	

	if ($result !== false && $result->num_rows > 0){
		echo "
          <script>
            alert('พบข้อมูลซ้ำ กรุณาลองอีกครั้ง')
            window.location.href = 'form_clothing_type.php'
          </script>
        ";
		
	}else{
		$insert = "INSERT INTO `clothing_type`(`clothingtype_name`) VALUES ('".$clothingtype_name."')";
		$result = $conn->query($insert);

	    if ($result === true) {
	      echo "
	        <script>
	          alert('บันทึกข้อมูลเรียบร้อย')
	          window.location.href = 'list_clothing_types.php'
	        </script>
	      ";
	    }else{
	      echo "
	        <script>
	          alert('บันทึกข้อมูลไม่สำเร็จ กรุณาลองอีกครั้ง')
	          window.location.href = 'form_clothing_type.php'
	        </script>
	      ";
	    }
	}


	
}

?>