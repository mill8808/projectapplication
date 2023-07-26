<?php 
    
  require("../conn.php");
  $user_id                      = "";
  $user_first_last_name         = "";
  $username                     = "";
  $password                     = "";
  $user_tel                     = "";
  $user_mail                    = "";


  if(isset($_GET["id"])) {
    $sql = "SELECT * FROM users WHERE user_id = ".$_GET["id"]." ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();

    $user_id                    = $_GET["id"];
    $user_first_last_name       = $row["user_first_last_name"];
    $username                   = $row["username"];
    $password                   = $row["password"];
    $user_tel                   = $row["user_tel"];
    $user_mail                  = $row["user_mail"];

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
                <?php if($user_id != ""){?>
                    <h3>แบบฟอร์มแก้ไขผู้ดูแลระบบ</h3>
                <?php }else{?>
                    <h3>แบบฟอร์มเพิ่มผู้ดูแลระบบ</h3>
                <?php }?>
                
            </div>

            <div class="col-lg-12">
                <form action="save_user.php" method="POST">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                
                <br><br>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">ชื่อ-นามสกุล</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ชื่อ-นามสกุล" name="user_first_last_name" value="<?= $user_first_last_name ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">เบอร์โทร</label>
                      <input type="text-dark" class="form-control" id="exampleFormControlInput1" placeholder="เบอร์โทร" name="user_tel" value="<?= $user_tel ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">อีเมล</label>
                      <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="user_mail" value="<?= $user_mail ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">username</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="username" name="username" value="<?= $username ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">password</label>
                      <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="password" name="password" value="<?= $password ?>" required>
                    </div>

                    <div class="offset-10 row">
                        <a href="list_users.php" class="btn btn-warning">
                            <i class="fas fa-arrow-left"></i> ย้อนกลับ
                        </a>
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