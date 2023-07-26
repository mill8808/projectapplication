<?php
include('../conn.php');

$clothing_type = $conn->query("SELECT * FROM `clothing_type`");

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
                <h3>ประเภทสินค้า</h3>
                <a href="form_clothing_type.php" class="btn btn-primary offset-9">
                    <i class="fas fa-user-plus"></i> เพิ่มประเภทสินค้า
                </a>
            </div>

            <div class="col-lg-12">
                <br><br>
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อประเภทสินค้า</th>
                        <th>ตัวเลือก</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($clothing_type as $key => $value): ?>
                        
                    
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $value['clothingtype_name']?></td>
                            <td>
                                <a href="form_clothing_type.php?id=<?= $value['clothingtype_id'] ?>" class="btn btn-warning"> 
                                    <i class="fas fa-edit"></i> แก้ไข
                                </a>                                
                                <a href="delete_clothing_type.php?id=<?= $value['clothingtype_id'] ?>" class="btn btn-danger">    <i class="fas fa-trash-alt"></i> ลบ
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    <!-- Products End -->


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