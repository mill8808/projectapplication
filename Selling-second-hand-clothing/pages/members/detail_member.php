<?php 
    
  require("../conn.php");
  $membe_id            = "";
  $member_name         = "";
  $username            = "";
  $password            = "";
  $member_tel          = "";
  $member_email        = "";
  $member_address      = "";
  $Pic_IDcard          = "";
  $picture             = "";


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
    $Pic_IDcard                 = $row["Pic_IDcard"];
    $picture                    = $row["picture"];

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
    <style type="text/css">
        .img {
          margin: 100px;
          transition: transform 0.25s ease;
          cursor: zoom-in;
        }
    </style>
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
                <h3>รายละเอียดข้อมูลสมาชิก</h3>
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
                        <div class="row"> 
                        <div class="col-md-6">
                            <label for="exampleFormControlInput1" class="form-label">
                                รูปบัตรประชาชน
                            </label><br>
                            <img src="uploads/<?= $Pic_IDcard ?>" width="300">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleFormControlInput1" class="form-label">
                                รูปถ่าย
                            </label><br>
                            <img src="uploads/<?= $picture ?>" width="300">
                        </div>
                        </div>
                      
                    </div>
                    

                    <div class="offset-8 row">
                        
                        <a 
                            href="list_members.php" 
                            class="btn btn-warning" 
                            style="margin-right: 1%;"
                        > 
                            <i class="fas fa-arrow-left"></i> ย้อนกลับ
                        </a>
                        <a 
                            href="save_comfirm_member.php?id=<?= $membe_id ?>&status=admin not accept" 
                            class="btn btn-danger"
                            style="margin-right: 1%;"
                        >
                            <i class="fas fa-window-close"></i> ไม่ผ่านการตรวจสอบ
                        </a>
                        <a 
                            href="save_comfirm_member.php?id=<?= $membe_id ?>&status=admin accept" 
                            class="btn btn-success"
                        >
                            <i class="fas fa-save"></i> ผ่านการตรวจสอบ
                        </a>
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