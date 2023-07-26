<?php
include('../conn.php');

$membe_id               = $_POST['membe_id'];
$member_name         		= $_POST['member_name'];
$username               = "-";
$password               = $_POST['password'];
$member_tel           	= $_POST['member_tel'];
$member_email           = $_POST['member_email'];
$member_address         = $_POST['member_address'];
$status         				= $_POST['accept_policy'];


if (!empty($_FILES["Pic_IDcard"]["name"])) {

	$file_name = md5($_FILES["Pic_IDcard"]["name"].time()); //ได้ชื่อ file
	$ext = explode('.', $_FILES["Pic_IDcard"]["name"]); //ได้นามสกุลไฟล์
	$dest = dirname(__FILE__).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$file_name.'.'.$ext[1]; //บอกว่าจะให้เก็บไฟล์ภาพที่ไหน

	if (!copy($_FILES["Pic_IDcard"]["tmp_name"], $dest)) {
	    # เช็คว่ามีการ uploade file มาไหม
	    echo "Uploade Error";
	    exit();
	}
	$Pic_IDcard = $file_name.'.'.$ext[1];
	

}else{
	$Pic_IDcard = "";
}

if (!empty($_FILES["picture"]["name"])) {

	$file_name = md5($_FILES["picture"]["name"].time()); //ได้ชื่อ file
	$ext = explode('.', $_FILES["picture"]["name"]); //ได้นามสกุลไฟล์
	$dest = dirname(__FILE__).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$file_name.'.'.$ext[1]; //บอกว่าจะให้เก็บไฟล์ภาพที่ไหน

	if (!copy($_FILES["picture"]["tmp_name"], $dest)) {
	    # เช็คว่ามีการ uploade file มาไหม
	    echo "Uploade Error";
	    exit();
	}
	$picture = $file_name.'.'.$ext[1];
	

}else{
	$picture = "";
}


if ($membe_id != "") {
	$sql = "SELECT * FROM `members` WHERE `member_name` = '".$member_name."' AND `member_email` = '".$member_email."' AND membe_id != '".$membe_id."'";
	$result = $conn->query($sql);
	

	if ($result !== false && $result->num_rows > 0){
		echo "
          <script>
            alert('พบข้อมูลซ้ำ กรุณาลองอีกครั้ง')
            window.location.href = 'form_member.php?id=$membe_id'
          </script>
        ";
		
	}else{
		$update = "UPDATE `members` SET   `member_name`			='".$member_name."',
																		`username`				='".$username."',
																		`password`				='".$password."',
																		`member_tel`			='".$member_tel."',
																		`member_email`		='".$member_email."', 
																		`member_address`	='".$member_address."' 
								  						WHERE `membe_id`				='".$membe_id."'";
		$result = $conn->query($update);



	    if ($result === true) {
	    	if($_SESSION["level"] == 'admin'){
		      echo "
		        <script>
		          alert('แก้ไขข้อมูลเรียบร้อย')
		          window.location.href = 'list_members.php'
		        </script>
		      ";
		    }else{
		    	echo "
		        <script>
		          alert('แก้ไขข้อมูลเรียบร้อย')
		          window.location.href = '/$projectname/'
		        </script>
		      ";
		    }
	    }else{
	      echo "
	        <script>
	          alert('แก้ไขข้อมูลไม่สำเร็จ กรุณาลองอีกครั้ง')
	          window.location.href = 'form_member.php?id=$membe_id'
	        </script>
	      ";
	    }				
	}

}else{
	$sql = "SELECT * FROM `members` WHERE `member_name` = '".$member_name."' OR `member_email` = '".$member_email."'";
	$result = $conn->query($sql);
	

	if ($result !== false && $result->num_rows > 0){
		// '-' คืิอมาจากหน้าสมัครสมาชิก
	  if ($member_address == '-') {
	  	echo "
      	<script>
        	alert('พบข้อมูลซ้ำ กรุณาลองอีกครั้ง')
        	window.location.href = '/$projectname/pages/manage_login/register.php'
      	</script>
    	";
	  }else{
			echo "
        <script>
          alert('พบข้อมูลซ้ำ กรุณาลองอีกครั้ง')
          window.location.href = 'form_member.php'
        </script>
      ";
    }
		
	}else{
		$insert = "INSERT INTO `members`(`member_name`, `username`, `password`, `member_tel`, `member_email`, `member_address`, `Pic_IDcard`, `picture`, `status`) VALUES ('".$member_name."','".$username."','".$password."','".$member_tel."','".$member_email."','".$member_address."','".$Pic_IDcard."','".$picture."','".$status."')";
		$result = $conn->query($insert);

	    if ($result === true) {
	    	// '-' คืิอมาจากหน้าสมัครสมาชิก
	    	if ($member_address == '-') {
	    		echo "
	        	<script>
	          	alert('สมัครสมาชิกเรียบร้อย รอเมลยืนยันผลการสมัครสมาชิก เพื่อเริ่มใช้งานระบบ')
	          	window.location.href = '/$projectname/'
	        	</script>
	      	";
	    	}else{
	    		echo "
	        	<script>
	          	alert('บันทึกข้อมูลเรียบร้อย')
	          	window.location.href = 'list_members.php'
	        	</script>
	      	";
	    	}
	      
	    }else{
	      echo "
	        <script>
	          alert('บันทึกข้อมูลไม่สำเร็จ กรุณาลองอีกครั้ง')
	          window.location.href = 'form_member.php'
	        </script>
	      ";
	    }
	}


	
}

?>