<?php 
    
  require("../conn.php");
  $clothingtype_id           = "";
  $clothingtype_name         = "";



  if(isset($_GET["id"])) {
    $sql = "SELECT * FROM clothing_type WHERE clothingtype_id = ".$_GET["id"]." ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();

    $clothingtype_id                 = $_GET["id"];
    $clothingtype_name               = $row["clothingtype_name"];


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
                <?php if($clothingtype_id != ""){?>
                    <h3>แบบฟอร์มแก้ไขประเภทสินค้า</h3>
                <?php }else{?>
                    <h3>แบบฟอร์มเพิ่มประเภทสินค้า</h3>
                <?php }?>
            </div>

            <div class="col-lg-12">
                <form action="save_clothing_type.php" method="POST">
                <input type="hidden" name="clothingtype_id" value="<?= $clothingtype_id ?>">
                
                <br><br>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">ชื่อประเภทชุด</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ชุดราตรียาว" name="clothingtype_name" value="<?= $clothingtype_name ?>" required>
                    </div>
                    

                    <div class="offset-10 row">
                        <a href="list_clothing_types.php" class="btn btn-warning">
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