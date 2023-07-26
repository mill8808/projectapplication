<?php
include('../conn.php');

$products = $conn->query("SELECT * FROM `products`");

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
                <h3>ข้อมูลสินค้า</h3>
                <a href="form_product.php" class="btn btn-primary offset-9">
                    <i class="fas fa-user-plus"></i> เพิ่มข้อมูลสินค้า
                </a>
            </div>

            <div class="col-lg-12">
                <br><br>
                <table class="table table-bordered">
                    <thead>
                      <tr align="center">
                        <th>ชื่อสินค้า</th>
                        <th>ราคา</th>
                        <th>ราคามัดจำ</th>
                        <th>รูป</th>
                        <!-- <th>จำนวนทั้งหมด</th> -->
                        <th>ตัวเลือก</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $key => $value): ?>
                        
                    
                        <tr>
                            <td><?= $value['product_name']?></td>
                            <td align="right"><?= number_format($value['product_price'],2)?></td>
                            <td align="right"><?= number_format($value['product_deposit'],2)?></td>
                            <td>
                                <img src="uploads/<?= $value['product_image1']?>" width="150">
                                
                                    
                            </td>
                            <!-- <td align="center"><?= $value['product_total']?></td> -->
                            <td>
                                <a href="form_product.php?id=<?= $value['product_id'] ?>" class="btn btn-warning"> 
                                    <i class="fas fa-edit"></i> แก้ไข
                                </a>                                
                                <a href="delete_product.php?id=<?= $value['product_id'] ?>" class="btn btn-danger">    <i class="fas fa-trash-alt"></i> ลบ
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