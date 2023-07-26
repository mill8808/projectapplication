<?php 
    
  require("../conn.php");
  $membe_id            = "";
  $member_name         = "";
  $username            = "";
  $password            = "";
  $member_tel          = "";
  $member_email        = "";
  $member_address      = "";


  if(isset($_GET["id"])) {
    $sql = "SELECT * FROM members WHERE membe_id = ".$_GET["id"]." ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();

    $membe_id                   = $_GET["id"];
    $member_name                = $row["member_name"];
    $username                   = $row["username"];
    $password                   = $row["password"];
    $member_tel                 = $row["member_tel"];
    $member_email               = $row["member_email"];
    $member_address             = $row["member_address"];

  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- title start-->
    <?php include('../layouts/title.php')?>
    <!-- title end-->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="../../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <?php include('../layouts/Topbar.php')?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-12">
                <?php include('../layouts/Navbar.php')?> 
                
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Products Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12 row">
                <?php if($membe_id != ""){?>
                    <h3>แบบฟอร์มแก้ไขข้อมูลสมาชิก</h3>
                <?php }else{?>
                    <h3>แบบฟอร์มเพิ่มข้อมูลสมาชิก</h3>
                <?php }?>

            </div>

            <div class="col-lg-12">
                <form action="save_member.php" method="POST">
                <input type="hidden" name="membe_id" value="<?= $membe_id ?>">
                
                <br><br>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">ชื่อ-นามสกุล</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ชื่อ-นามสกุล" name="member_name" value="<?= $member_name ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">เบอร์โทร</label>
                      <input type="text-dark" class="form-control" id="exampleFormControlInput1" placeholder="เบอร์โทร" name="member_tel" value="<?= $member_tel ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">อีเมล</label>
                      <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="member_email" value="<?= $member_email ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">username</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="username" name="username" value="<?= $username ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">password</label>
                      <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="password" name="password" value="<?= $password ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">ที่อยู่</label>
                      <textarea class="form-control" id="member_address" name="member_address" rows="3"><?= $member_address ?></textarea>
                    </div>

                    <div class="offset-10 row">
                        <?php if($_SESSION["level"] == 'admin'){?>
                        <a href="list_members.php" class="btn btn-warning">
                            <i class="fas fa-arrow-left"></i> ย้อนกลับ
                        </a>
                        <?php }else{?>
                        <a href="/<?= $projectname ?>/" class="btn btn-warning">
                            <i class="fas fa-arrow-left"></i> ย้อนกลับ
                        </a>
                        <?php }?>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> บันทึก
                        </button>
                    </div>
                    <br>
                
            </div>
            
            </form>
        </div>
        
    </div>
    <!-- Products End -->
    <br>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>