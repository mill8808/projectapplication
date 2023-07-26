<?php
	session_start();
	$projectname = "Selling-second-hand-clothing";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "Selling_clothing_DB";
	$timezone = date_default_timezone_set("Asia/Bangkok");
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 


	$months = explode("_",'มกราคม_กุมภาพันธ์_มีนาคม_เมษายน_พฤษภาคม_มิถุนายน_กรกฎาคม_สิงหาคม_กันยายน_ตุลาคม_พฤศจิกายน_ธันวาคม');




?>