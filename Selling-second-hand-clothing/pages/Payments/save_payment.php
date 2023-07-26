<?php
require("../conn.php");

// rantal
$rental_id		= $_POST['rental_id'];
$namerecive		= $_POST['namerecive'];
$telrecive		= $_POST['telrecive'];
$addressrecive	= $_POST['addressrecive'];
$village		= $_POST['village'];
$alley			= $_POST['alley'];
$province		= $_POST['province'];
$amphur			= $_POST['amphur'];
$district		= $_POST['district'];
$postcode		= $_POST['postcode'];
$status			= 'รอจัดส่งชุด';


// payment
$paydate		= $_POST['paydate'];
$paytime		= $_POST['paytime'];
$payamount		= $_POST['payamount'];
// $picture		= $_POST['picture'];
$sumtotal		= $_POST['sumtotal'];
$account_return_despoit		= $_POST['account_return_despoit'];

if(($payamount > $sumtotal) OR ($payamount < $sumtotal)){
	echo "<script>
			alert('จำนวนเงินไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
			window.location.href='form_Payments.php?id=$rental_id';
			</script>";
}else{
	$upload = "UPDATE `rentals` SET `status`			='".$status."',
									`addressrecive`		='".$addressrecive."',
									`village`			='".$village."',
									`alley`				='".$alley."',
									`province`			='".$province."',
									`amphur`			='".$amphur."',
									`district`			='".$district."',
									`postcode`			='".$postcode."',
									`telrecive`			='".$telrecive."',
									`namerecive`		='".$namerecive."' 
								WHERE `rental_id`		='".$rental_id."'";
	if ($conn->query($upload) === TRUE) { //เช็คว่าสามารถบันทึกข้อมูลได้ไหม
			
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
		}

		$insert = "INSERT INTO `payments`(`rantal_id`, `paydate`, `paytime`, `payamount`, `picture`, `account_return_despoit`) VALUES ('".$rental_id."','".$paydate."','".$paytime."','".$payamount."','".$picture."','".$account_return_despoit."')";

		if ($conn->query($insert) === TRUE) { //เช็คว่าสามารถบันทึกข้อมูลได้ไหม
			echo "
		        <script>
		          alert('บันทึกข้อมูล การชำระเงินเรียบร้อย')
		          window.location.href = '/$projectname/'
		        </script>
		      ";
		}else{
			echo "Error: " . $insert . "<br>" . $conn->error;
		}
	} else {
		echo "Error: " . $upload . "<br>" . $conn->error;
	} // end เช็คว่าสามารถบันทึกข้อมูลได้ไหม


	
}


?>