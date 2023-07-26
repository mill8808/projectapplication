<?php
	
	require("../conn.php");

	$uername 	= $_POST['email'];
	$password 	= $_POST['pass'];


	$sql = "SELECT * FROM `users` WHERE `user_mail` = '".$uername."' AND `password` = '".$password."'";
	$result = mysqli_query($conn, $sql);

	$count = 0;
	$countMem = 0;

	foreach ($result as $key => $User) {
		$_SESSION["name"] 			= $User['user_first_last_name'];
		$_SESSION["id"] 			= $User['user_id'];
		$_SESSION["level"] 			= 'admin';
		$count ++;
	}

	if ($count > 0) {
		header( "location: /$projectname/" ); //ไปยังหน้าหลัก

	}else{
		$sql = "SELECT * FROM `members` WHERE `member_email` = '".$uername."' AND `password` = '".$password."'";
		$result = $conn->query($sql);
		$rowMember = $result->fetch_array();

		if ($rowMember['status'] == 'user accept policy'){
			echo "<script>
			alert('อยู่ระหว่าง ผู้ดูแลระบบตรวจสอบข้อมูล\\n\\n\\กรุณารอเมลยืนยันผลการตรวจสอบ');
			window.location.href='/$projectname/pages/manage_login/index.php';
			</script>";

		}elseif($rowMember['status'] == 'admin not accept'){
			echo "<script>
			alert('คุณไม่ผ่านการตรวจสอบ \\n\\n\\กรุณาติดต่อ ผู้ดูแลระบบ');
			window.location.href='/$projectname/pages/manage_login/index.php';
			</script>";

		}else{
			foreach ($result as $key => $mem) {
				$_SESSION["name"] 		= $mem['member_name'];
				$_SESSION["id"] 		= $mem['membe_id'];
				$_SESSION["tel"] 		= $mem['member_tel'];
				$_SESSION["level"] 		= 'member';
				$_SESSION["status"] 	= $mem['status'];

				$countMem ++;
			}

			if ($countMem > 0) {
				header( "location: /$projectname/" ); //ไปยังหน้าหลัก

			}else{
				echo "<script>
				alert('Username หรือ Password ไม่ถูกต้อง\\n\\n\\nกรุณาลองใหม่อีกครั้ง!!');
				window.location.href='/$projectname/pages/manage_login/index.php';
				</script>";

			}
		}
	
	}

	$conn->close();


?>