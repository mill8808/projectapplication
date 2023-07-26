<?php
require("../conn.php");

$rental_pick_up_date 	= date("Y-m-d", strtotime($_POST["rental_pick_up_date"]));
$rental_return_date 	= date("Y-m-d", strtotime($_POST["rental_return_date"]));
$rental_id 				= $_POST["rental_id"];
$status					= 'รอชำระเงิน';


if (($_POST["rental_pick_up_date"] == "") AND ($_POST["rental_return_date"] == "")) {
	echo "<script>
		alert('กรุณาระบุวันที่ต้องการจัดส่ง หรือวันที่ต้องการส่งคืน ');
		window.location.href='list_rentals.php';
		</script>";

}else{

// หาจำนวนระยะห่างของวัน เพื่อตรวจสอบการสั่งจองล่วงหน้า เช่น
	// สั่งเช่าชุดล่วงหน้าอย่างน้อยสามวัน 3 วัน
	$datediff = datediff(date("Y-m-d"),$rental_pick_up_date); 
	$countordercheck = checkOrder($rental_pick_up_date,$rental_return_date,$rental_id);


	if ($datediff <= 1) {
		echo "<script>
			alert('กรุณาเลือกวันใหม่อีกครั้ง เนื่องต้องจองล่วงหน้าอย่างน้อย 1 วัน');
			window.location.href='list_rentals.php';
			</script>";
	}else{
		if ($countordercheck > 0){
			echo "<script>
			alert('กรุณาเลือกวันใหม่อีกครั้ง เนื่องจากวันที่เลือกมีการจองครบตามจำนวนที่กำหนด');
			window.location.href='list_rentals.php';
			</script>";
		}else{
			updateOrder($rental_pick_up_date,$rental_return_date,$rental_id,$status);
		}
	}
}



function checkOrder($rental_pick_up_date,$rental_return_date,$rental_id){
	include ("../conn.php");
	$countrental = 0;
	$arrat_rental_id = [];

	$results = $conn->query("SELECT * FROM `rentals` WHERE `status` != 'ได้รับสินค้าคืนเรียบร้อย' AND `rental_id` != '".$rental_id."'");

	foreach ($results as $key => $value) {
		if (($rental_pick_up_date > $value['rental_pick_up_date']) AND (($rental_pick_up_date < $value['rental_return_date']))) {
			array_push($arrat_rental_id, $value['rental_id']);
		}
	}

	echo count($arrat_rental_id)."<br>";

	if (count($arrat_rental_id) == 0) {
		$countrental = 0;
	}else{
		foreach ($arrat_rental_id as $key => $value) {
			$rental_details = $conn->query("SELECT `product_id` FROM `rental_details` WHERE `rental_id` = '".$value."'");
			$rental_detail_order_now = $conn->query("SELECT rental_details.product_id AS product_id FROM `rentals` INNER JOIN rental_details ON rentals.rental_id = rental_details.rental_id WHERE rentals.rental_id = '".$rental_id."'");

			foreach ($rental_detail_order_now as $key => $valNow) {
				foreach ($rental_details as $key => $val) {
					if($valNow['product_id'] == $val['product_id']){
						$countrental++;
					}
				}
				// code...
			}
			echo $value."<br>";
		}
	}

	return $countrental;
}

function updateOrder($rental_pick_up_date,$rental_return_date,$rental_id,$status){
	include ("../conn.php");
	$update = "UPDATE `rentals` SET `rental_date`			='".date('Y-m-d')."',
									`rental_pick_up_date`	='".$rental_pick_up_date."',
									`rental_return_date`	='".$rental_return_date."',
									`status`				='".$status."' 
								WHERE `rental_id`			='".$rental_id."'";


	if ($conn->query($update) === TRUE) { //เช็คว่าสามารถบันทึกข้อมูลได้ไหม
		echo "<script>
				alert('ยืนยันการสั่งซื้อเรียบร้อย กรุณาแจ้งชำระเงิน');
				window.location.href='/$projectname/pages/Payments/list_Payments.php';
				</script>";
	}else{
		echo "Error: " . $update . "<br>" . $conn->error;
	}
}


function datediff ( $start, $end ) {
   $datediff = strtotime(dateform($end)) - strtotime(dateform($start));
   return floor($datediff / (60 * 60 * 24));
}

function dateform($date){

   $d = explode('-',$date);
   return $d[2].'-'.$d[1].'-'.$d[0];
}

?>