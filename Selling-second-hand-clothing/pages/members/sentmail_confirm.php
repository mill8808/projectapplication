<?php


/**
* This example shows making an SMTP connection with authentication.
*/
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Asia/Bangkok');
require("../../lib/PHPMailer/src/PHPMailer.php");
require("../../lib/PHPMailer/src/SMTP.php");
require("../../lib/PHPMailer/src/Exception.php");
	$email  = $_GET['email'];
    $status = $_GET['status'];
    $txt    = "";

    if ($status == "admin accept") {
        $txt = 'ท่านผ่านการตรวจสอบข้อมูลการสมัครเข้าใช้งานเว็บไซต์ <br> ท่านสามามรถเริ่มใช้งานเว็บไซต์ ได้ที่ http://localhost/Selling-second-hand-clothing/';
    }else{
        $txt = 'ท่านไม่ผ่านการตรวจสอบข้อมูลการสมัครเข้าใช้งานเว็บไซต์ <br> สามารถติดต่อผู้ดูแลระบบ ผ่านช่องทางตามรายละเอียดบนหน้าเว็บ http://localhost/Selling-second-hand-clothing/contact.php';
    }

   	$mail = new PHPMailer\PHPMailer\PHPMailer();
   	$mail->IsSMTP(); 

   	$mail->CharSet="UTF-8";
   	$mail->Host = "smtp.gmail.com";
   	$mail->SMTPDebug = 1; 
   	$mail->Port = 465 ; //465 or 587

 	  $mail->SMTPSecure = 'ssl';  
   	$mail->SMTPAuth = true; 
   	$mail->IsHTML(true);

   	//Authentication
   	$mail->Username = "byiira.th@gmail.com";
   	$mail->Password = "fmodmbwdmlpyzwbk";

   	//Set Params
   	$mail->SetFrom("byiira.th@gmail.com");
   	$mail->AddAddress($email);
   	$mail->Subject = "ผลการสมัครสมาชิก";
   	$mail->Body = $txt;


   	if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
   	} else {

        echo "
        <script>
          alert('บันทึกข้อมูล และส่ง email ยืนยันเรียบร้แย')
          window.location.href = 'list_members.php'
        </script>
      ";

   	}
?>