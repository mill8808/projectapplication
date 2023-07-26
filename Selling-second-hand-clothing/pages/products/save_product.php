<?php
include('../conn.php');

$product_id             = $_POST["product_id"];
$clothingtype_id        = $_POST["clothingtype_id"];
$product_name           = $_POST["product_name"];
$product_detail         = $_POST["product_detail"];
$product_price          = $_POST["product_price"];
$product_total          = 0;
$product_deposit        = $_POST["product_deposit"];
$product_size           = $_POST["product_size"];



if (!empty($_FILES["product_image1"]["name"])) {

	$file_name = md5($_FILES["product_image1"]["name"].time()); //ได้ชื่อ file
	$ext = explode('.', $_FILES["product_image1"]["name"]); //ได้นามสกุลไฟล์
	$dest = dirname(__FILE__).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$file_name.'.'.$ext[1]; //บอกว่าจะให้เก็บไฟล์ภาพที่ไหน

	if (!copy($_FILES["product_image1"]["tmp_name"], $dest)) {
	    # เช็คว่ามีการ uploade file มาไหม
	    echo "Uploade Error";
	    exit();
	}
	$product_image1 = $file_name.'.'.$ext[1];
	

}else{
	$product_image1 = $_POST['product_image1_old'];
}

if (!empty($_FILES["product_image2"]["name"])) {

	$file_name = md5($_FILES["product_image2"]["name"].time()); //ได้ชื่อ file
	$ext = explode('.', $_FILES["product_image2"]["name"]); //ได้นามสกุลไฟล์
	$dest = dirname(__FILE__).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$file_name.'.'.$ext[1]; //บอกว่าจะให้เก็บไฟล์ภาพที่ไหน

	if (!copy($_FILES["product_image2"]["tmp_name"], $dest)) {
	    # เช็คว่ามีการ uploade file มาไหม
	    echo "Uploade Error";
	    exit();
	}
	$product_image2 = $file_name.'.'.$ext[1];
	

}else{
	$product_image2 = $_POST['product_image2_old'];
}

if (!empty($_FILES["product_image3"]["name"])) {

	$file_name = md5($_FILES["product_image3"]["name"].time()); //ได้ชื่อ file
	$ext = explode('.', $_FILES["product_image3"]["name"]); //ได้นามสกุลไฟล์
	$dest = dirname(__FILE__).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$file_name.'.'.$ext[1]; //บอกว่าจะให้เก็บไฟล์ภาพที่ไหน

	if (!copy($_FILES["product_image3"]["tmp_name"], $dest)) {
	    # เช็คว่ามีการ uploade file มาไหม
	    echo "Uploade Error";
	    exit();
	}
	$product_image3 = $file_name.'.'.$ext[1];
	

}else{
	$product_image3 = $_POST['product_image3_old'];
}

if (!empty($_FILES["product_image4"]["name"])) {

	$file_name = md5($_FILES["product_image4"]["name"].time()); //ได้ชื่อ file
	$ext = explode('.', $_FILES["product_image4"]["name"]); //ได้นามสกุลไฟล์
	$dest = dirname(__FILE__).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$file_name.'.'.$ext[1]; //บอกว่าจะให้เก็บไฟล์ภาพที่ไหน

	if (!copy($_FILES["product_image4"]["tmp_name"], $dest)) {
	    # เช็คว่ามีการ uploade file มาไหม
	    echo "Uploade Error";
	    exit();
	}
	$product_image4 = $file_name.'.'.$ext[1];
	

}else{
	$product_image4 = $_POST['product_image4_old'];
}


if ($product_id  != "") {
	$sql = "SELECT * FROM `products` WHERE `product_name` = '".$product_name."' AND product_id != '".$product_id."'";
	$result = $conn->query($sql);
	

	if ($result !== false && $result->num_rows > 0){
		echo "
          <script>
            alert('พบข้อมูลซ้ำ กรุณาลองอีกครั้ง')
            window.location.href = 'form_product.php?id=$product_id'
          </script>
        ";
		
	}else{
		$update = "UPDATE `products` SET `clothingtype_id`		='".$clothingtype_id."',
										 `product_name`			='".$product_name."',
										 `product_detail`		='".$product_detail."',
										 `product_price`		='".$product_price."',
										 `product_total`		='".$product_total."',
										 `product_deposit`		='".$product_deposit."',
										 `product_size`			='".$product_size."',
										 `product_image1`		='".$product_image1."',
										 `product_image2`		='".$product_image2."',
										 `product_image3`		='".$product_image3."',
										 `product_image4`		='".$product_image4."' 
								     WHERE `product_id`			='".$product_id."'";
		$result = $conn->query($update);

	    if ($result === true) {
	      echo "
	        <script>
	          alert('แก้ไขข้อมูลเรียบร้อย')
	          window.location.href = 'list_products.php'
	        </script>
	      ";
	    }else{
	      echo "
	        <script>
	          alert('แก้ไขข้อมูลไม่สำเร็จ กรุณาลองอีกครั้ง')
	          window.location.href = 'form_product.php?id=$product_id'
	        </script>
	      ";
	    }	
	}
}else{
	$sql = "SELECT * FROM `products` WHERE `product_name` = '".$product_name."'";
	$result = $conn->query($sql);
	

	if ($result !== false && $result->num_rows > 0){
		echo "
          <script>
            alert('พบข้อมูลซ้ำ กรุณาลองอีกครั้ง')
            window.location.href = 'form_product.php'
          </script>
        ";
		
	}else{
		$insert = "INSERT INTO `products`(`clothingtype_id`,`product_name`, `product_detail`, `product_price`, `product_total`, `product_deposit`, `product_size`, `product_image1`, `product_image2`, `product_image3`, `product_image4`) VALUES ('".$clothingtype_id."','".$product_name."','".$product_detail."','".$product_price."','".$product_total."','".$product_deposit."','".$product_size."','".$product_image1."','".$product_image2."','".$product_image3."','".$product_image4."')";
		$result = $conn->query($insert);

	    if ($result === true) {
	      echo "
	        <script>
	          alert('บันทึกข้อมูลเรียบร้อย')
	          window.location.href = 'list_products.php'
	        </script>
	      ";
	    }else{
	      // echo "
	      //   <script>
	      //     alert('บันทึกข้อมูลไม่สำเร็จ กรุณาลองอีกครั้ง')
	      //     window.location.href = 'form_product.php'
	      //   </script>
	      // ";
	    }
	}
}
	





?>