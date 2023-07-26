<?php
// session_start();
require("../conn.php");

if (!isset($_SESSION['id'])) {
echo "<script>
    alert('กรุณาเข้าสู่ระบบ ก่อนสั่งซื้อสินค้า');
    window.location.href='/$projectname/index.php';
    </script>";
}else{
	$product_id    	= $_GET['id'];
    $status_btn     = $_GET['status'];
    $total        	= 1;
    $member_id     	= $_SESSION['id'];
    $rental_date   	= date('Y-m-d');
    $status 		= 'รอยืนยันการเช่าชุด';


    $Products = $conn->query("SELECT * FROM `products` WHERE `product_id` = '".$product_id."'");
    $Product  = $Products->fetch_array();


    $rentals = $conn->query("SELECT * FROM `rentals` WHERE `member_id` = '".$_SESSION['id']."' AND `status` = '".$status."'");
    $countrental = $rentals->num_rows;
    $rental      = $rentals->fetch_array();

    if ($countrental == 0) {
    	$insert = "INSERT INTO `rentals`(`rental_date`, `member_id`,`status`) VALUES ('".$rental_date."','".$member_id."','".$status."')";
      	if ($conn->query($insert)) {
        	$rental_id = $conn->insert_id;
        	insertOrderDetail($rental_id,$product_id,$Product['product_price'],$Product['product_deposit'],$total,$status_btn);
      	}else{
        	echo "Error: " . $insert . "<br>" . $conn->error;
      	}
    }else{
    	$rental_id = $rental['rental_id'];
      	$queryOrderDetails = $conn->query("SELECT * FROM `rental_details` WHERE `rental_id` = '".$rental_id."' AND `product_id` = '".$product_id."'");
      	$countOrderDetail = $queryOrderDetails->num_rows;
      	$OrderDetails     = $queryOrderDetails->fetch_array();

      	if ($countOrderDetail == 0) {
        	insertOrderDetail($rental_id,$product_id,$Product['product_price'],$Product['product_deposit'],$total,$status_btn);
      	}else{
            echo "<script>
                alert('สินค้าอยู่ในตะกร้าเรียบร้อย');
                window.location.href='/$projectname/index.php';
                </script>";
            // insertOrderDetail($rental_id,$product_id,$Product['product_price'],$Product['product_deposit'],$total);
        	// $total += $OrderDetails['total'];
        	// $update = "UPDATE `rental_details` SET`total`='".$total."' WHERE `rental_detail_id`='".$OrderDetails['rental_detail_id']."'";
        	// if ($conn->query($update)) {
		    //     echo "<script>
		    //     alert('เพิ่มข้อมูลการสั่งซื้อเรียบร้อย');
		    //     window.location.href='/$projectname/index.php';
		    //     </script>";
		    // }else{
		    //     echo "Error: " . $sql . "<br>" . $conn->error;
		    // }
      }
    }

}

function insertOrderDetail($rental_id,$product_id,$product_price,$product_deposit,$total,$status_btn){
    require("../conn.php");
    $insertOrderDetail = "INSERT INTO `rental_details`(`rental_id`,`product_id`, `total`, `price_on_rental_date`, `deposit_on_rental_date`) VALUES ('".$rental_id."','".$product_id."','".$total."','".$product_price."','".$product_deposit."')";
    if ($conn->query($insertOrderDetail)) {
        if ($status_btn == 'ซื้อสินค้า') {
            echo "<script>
            alert('เพิ่มข้อมูลการสั่งซื้อเรียบร้อย');
            window.location.href='/$projectname/pages/rentals/list_rentals.php';
            </script>";
        }else{
            echo "<script>
            alert('เพิ่มข้อมูลการสั่งซื้อเรียบร้อย');
            window.location.href='/$projectname/index.php';
            </script>"; 
        }
        
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}







?>