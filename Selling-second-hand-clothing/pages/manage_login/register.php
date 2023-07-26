<?php 
require("../conn.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('../layouts/title.php')?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<!--  -->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/1.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="/<?= $projectname ?>/pages/members/save_member.php" method="POST" enctype="multipart/form-data">
					<input 
                      		type="hidden" 
                      		class="form-control" 
                      		id="member_address" 
                      		name="member_address" 
                      		value="-" 
                      		required
                      	>
					<span class="login100-form-title">
						สมัครสมาชิก
					</span>
					<div class="mb-3">
                      	<label for="exampleFormControlInput1" class="form-label">ชื่อ-นามสกุล</label>
                      	<input 
                      		type="text" 
                      		class="form-control" 
                      		id="member_name" 
                      		placeholder="ชื่อ-นามสกุล" 
                      		name="member_name" 
                      		value="" 
                      		required
                      	>
                    </div>
                    <div class="mb-3">
                      	<label for="exampleFormControlInput1" class="form-label">เบอร์โทร</label>
                      	<input 
                      		type="text" 
                      		class="form-control" 
                      		id="member_tel" 
                      		placeholder="เบอร์โทร" 
                      		name="member_tel" 
                      		value="" 
                      		required
                      	>
                    </div>
                    <div class="mb-3">
                      	<label for="exampleFormControlInput1" class="form-label">อีเมล</label>
                      	<input 
                      		type="email" 
                      		class="form-control" 
                      		id="member_email" 
                      		placeholder="อีเมล" 
                      		name="member_email" 
                      		value="" 
                      		required
                      	>
                    </div>
                    <div class="mb-3">
                      	<label for="exampleFormControlInput1" class="form-label">รูปบัตรประชาชน</label>
                      	<input 
                      		type="file" 
                      		class="form-control" 
                      		id="Pic_IDcard" 
                      		placeholder="Pic_IDcard" 
                      		name="Pic_IDcard" 
                      		value="" 
                      		required
                      	>
                    </div>
                    <div class="mb-3">
                      	<label for="exampleFormControlInput1" class="form-label">รูปถ่าย</label>
                      	<input 
                      		type="file" 
                      		class="form-control" 
                      		id="picture" 
                      		placeholder="picture" 
                      		name="picture" 
                      		value="" 
                      		required
                      	>
                    </div>
                    <div class="mb-3">
                      	<label for="exampleFormControlInput1" class="form-label">password</label>
                      	<input 
                      		type="password" 
                      		class="form-control" 
                      		id="password" 
                      		placeholder="password" 
                      		name="password" 
                      		value="" 
                      		required
                      	>
                    </div>
                    
					
					<label for="accept_policy">
						<input type="checkbox" id="accept_policy" name="accept_policy" value="user accept policy" onclick="show_btn_register()">&nbsp; ข้าพเจ้าขอรับรองว่าข้อมูลในใบสมัครฉบับนี้มีความครบถ้วน ถูกต้องและตรงตามความเป็นจริงทุกประการ และยินยอมให้ Byiira จัดเก็บข้อมูลส่วนบุคคล และเผยแพร่ข้อมูลหรือใช้ข้อมูลดำเนินคดีความตามกฎหมายได้ หากข้าพเจ้าทำผิดสัญญา
						<!-- Button trigger modal -->
						<a 
							class="btn btn-link" 
							data-toggle="modal" 
							data-target="#exampleModal" 
						>
						  <font color="blue"><u>นโยบายการเปิดเผยข้อมูลส่วนบุคคล</u></font>
						</a>
					</label><br>

					

					<!-- Modal -->
					<div 
						class="modal fade" 
						id="exampleModal" 
						tabindex="-1" 
						role="dialog" 
						aria-labelledby="exampleModalLabel" 
						aria-hidden="true"
					>
					  <div class="modal-dialog modal-lg" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">
					        	นโยบายการเปิดเผยข้อมูลส่วนบุคคล
					        </h5>
					        <button 
					        	type="button" 
					        	class="close" 
					        	data-dismiss="modal" 
					        	aria-label="Close"
					        >
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        <p>ข้อตกลงการให้ความยินยอมในการเปิดเผยข้อมูลส่วนบุคคล ข้าพเจ้า ซึ่งเป็นผู้ใช้บริการ (“ผู้ใช้บริการ”)</p><br>
					        <p>ยินยอมให้เก็บรวบรวม ใช้ข้อมูลส่วนบุลคลของข้าพเจ้า การเปิดเผยข้อมูลส่วนบุคคลของข้าพเจ้าที่มีอยู่ ตามภายใต้ข้อกำหนดและเงื่อนไขของ <b>”Byiira”</b> ในการเช่าสินค้า</p><br>

							<p><b>สัญญาการเช่า</b></p> 
							<p>มีคู่สัญญา 2 ฝ่าย ได้แก่ ผู้ให้เช่าซื้อ (Byiira) ฝ่ายหนึ่ง และผู้เช่าซื้อ (ลูกค้า ผู้บริโภค) อีกฝ่ายหนึ่ง โดยที่ คู่สัญญาทั้ง 2 ฝ่ายตกลงกันเช่าสินค้าตามเงื่อนไขของ <b>Byiira </b></p>

							<p>&nbsp;-&nbsp;เพื่อเป็นการประกันความเสียหาย การเช่าสินค้าต้องเก็บค่ามัดจำสินค้า โดยจะคิดตามที่ Byiira กำหนด ราคาแต่ละใบค่ามัดจำอาจไม่เท่ากัน</p>

							<p>&nbsp;-&nbsp;หากต้องการเช่าสินค้าต่อต้องแจ้งล้วงหน้าอย่างน้อย 1 วัน โดยวันเช่าจะต้องไม่ซ้ำกับลูกค้าท่านอื่นหากเกินกำหนดแล้วไม่แจ้งล่วงหน้าทางร้านขออนุญาติปรับเป็น (ราคาเช่าของสินค้ารายวัน 3 เท่า) : ต่อ 1 วันที่เกินกำหนด ขออนุญาติปรับจนกว่าจะคืนสินค้า หากไม่ชำระ Byiira สามารถดำเนินคดีตามกฎหมายได้</p>

							<p>&nbsp;-&nbsp;เมื่อครบวันกำหนดเช่าลูกค้าต้องทำการส่งคืน หากไม่ส่งคืน Byiira สามารถนำข้อมูลส่วนบุคคลไปแจ้งดำเนินคดีตามกฎหมายได้ ไม่มีการยอมความ แจ้งดำเนินคดีพร้อมเรียกค่าเสียหายจนถึงที่สุด</p>

							<p>&nbsp;-&nbsp;สินค้าเป็นสินค้าเช่า ทำให้สภาพสินค้าอาจไม่ใหม่ 100% มีสภาพตามอายุการใช้งานจริง</p>

							<p>&nbsp;-&nbsp;ผู้เช่าสินค้าไม่มีสิทธิ นำสินค้าไปขายหรือส่งต่อให้ผู้อื่น ไม่ดัดแปลงต่อเติมหรือกระทำการใดๆให้สินค้าเสียหาย หากเสียหายทางร้านขอปรับเป็นจำนวนราคาจริงของกระเป๋า</p>

							<br>
							<p><b>วัตถุประสงค์การเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคล</b></p>

							<p>เพื่อให้บริการตรงตามต้องการของผู้ใช้บริการ BYIIRA จะสามารถใช้ข้อมูลส่วนบุคคลของผู้ใช้บริการ เพื่อที่ผู้ใช้บริการจะสามารถเช่าสินค้าบริการตรงตามวัตถุประสงค์ของผู้ใช้บริการ เพื่อเป็นหลักฐานการมัดจำ หากผิดสัญญา BYIIRA สามารถนำข้อมูลไปใช้ดำเนินตามคดีตามกฎหมายได้</p>
							
							<br>
							<p><b>หมายเหตุ :</b></p>
							<p>ข้อมูลส่วนตัวจะไม่นำไปเผยแพร่หากลูกค้าไม่ทำผิดตามสัญญาการเช่า</p>
					      </div>
					      <div class="modal-footer">
					        <button 
					        	type="button" 
					        	class="btn btn-primary"
					        	data-dismiss="modal"
					        	onclick="accept_fn()"
					        >
					        	ฉันเข้าใจและยอมรับนโยบายส่วนบุคคล
					        </button>
					      </div>
					    </div>
					  </div>
					</div>

					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="btn_register">
							สมัครสมาชิก
						</button>
					</div>
					<div class="text-center p-t-136">
						<a class="txt2" href="/<?= $projectname ?>/">
							
							<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
							ย้อนกลับ
						</a>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
		show_btn_register()

		function accept_fn(){
			document.getElementById("accept_policy").checked = true
			show_btn_register()
		}

		function show_btn_register(){
			var statusTxt = document.getElementById("accept_policy").checked
			var x = document.getElementById("btn_register")
			console.log(statusTxt)
			if (statusTxt === true) {
				x.style.display = "block";
			}else{
				x.style.display = "none";
			}
		}
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>