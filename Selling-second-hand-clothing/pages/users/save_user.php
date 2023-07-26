<?php
include('../conn.php');

$user_id                      = $_POST['user_id'];
$user_first_last_name         = $_POST['user_first_last_name'];
$username                     = $_POST['username'];
$password                     = $_POST['password'];
$user_tel                     = $_POST['user_tel'];
$user_mail                    = $_POST['user_mail'];


if ($user_id != "") {
	$sql = "SELECT * FROM `users` WHERE `user_first_last_name` = '".$user_first_last_name."' OR `username` = '".$username."' AND user_id != '".$user_id."'";
	$result = $conn->query($sql);
	

	if ($result !== false && $result->num_rows > 0){
		echo "
          <script>
            alert('พบข้อมูลซ้ำ กรุณาลองอีกครั้ง')
            window.location.href = 'form_user.php?id=$user_id'
          </script>
        ";
		
	}else{
		$update = "UPDATE `users` SET   `user_first_last_name`	='".$user_first_last_name."',
										`username`				='".$username."',
										`password`				='".$password."',
										`user_tel`				='".$user_tel."',
										`user_mail`				='".$user_mail."' 
								  WHERE `user_id`				='".$user_id."'";
		$result = $conn->query($update);

	    if ($result === true) {
	    	$_SESSION["name"] = $user_first_last_name;
	      echo "
	        <script>
	          alert('แก้ไขข้อมูลเรียบร้อย')
	          window.location.href = 'list_users.php'
	        </script>
	      ";
	    }else{
	      echo "
	        <script>
	          alert('แก้ไขข้อมูลไม่สำเร็จ กรุณาลองอีกครั้ง')
	          window.location.href = 'form_user.php?id=$user_id'
	        </script>
	      ";
	    }				
	}

}else{
	$sql = "SELECT * FROM `users` WHERE `user_first_last_name` = '".$user_first_last_name."' AND `username` = '".$username."'";
	$result = $conn->query($sql);
	

	if ($result !== false && $result->num_rows > 0){
		echo "
          <script>
            alert('พบข้อมูลซ้ำ กรุณาลองอีกครั้ง')
            window.location.href = 'form_user.php'
          </script>
        ";
		
	}else{
		$insert = "INSERT INTO `users`(`user_first_last_name`, `username`, `password`, `user_tel`, `user_mail`) VALUES ('".$user_first_last_name."','".$username."','".$password."','".$user_tel."','".$user_mail."')";
		$result = $conn->query($insert);

	    if ($result === true) {
	      echo "
	        <script>
	          alert('บันทึกข้อมูลเรียบร้อย')
	          window.location.href = 'list_users.php'
	        </script>
	      ";
	    }else{
	      echo "
	        <script>
	          alert('บันทึกข้อมูลไม่สำเร็จ กรุณาลองอีกครั้ง')
	          window.location.href = 'form_user.php'
	        </script>
	      ";
	    }
	}


	
}

?>