<?php 
    
    require("../conn.php");

    $products = $conn->query("SELECT * FROM `Favorites` INNER JOIN products ON Favorites.product_id = products.product_id WHERE `member_id` = '".$_SESSION["id"]."'");


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
    <link href="img/favicon.ico" rel="icon">

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
    <div class="container-fluid mb-5">
        <div class="row px-xl-5">
            <div class="col-lg-12 d-none d-lg-block">
                <div class="container-fluid pt-5">
                    <div class="mb-4">
                        <h2 class="section-title px-5"><span class="px-2">สินค้ารายการโปรด</span></h2>
                    </div>
                    <div class="row px-xl-5 pb-3">
                        <?php foreach ($products as $key => $value): ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img 
                                        class="img-fluid w-100" 
                                        src="../products/uploads/<?= $value['product_image1']?>" 
                                        alt=""
                                        width="100"
                                    >
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"><?= $value['product_name']?></h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>ราคา : <?= number_format($value['product_price'],2)?> บาท</h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a 
                                        href="../products/detail_product.php?id=<?= $value['product_id'] ?>" 
                                        class="btn btn-sm text-dark p-0"
                                    >
                                        <i class="fas fa-eye text-primary mr-1"></i>ดูรายละเอียด
                                    </a>
                                    <a href="" class="btn btn-sm text-dark p-0">
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i>เพิ่มลงตระกร้า
                                    </a>
                                    <a 
                                        href="delete_Favorite.php?id=<?= $value['product_id'] ?>" 
                                        class="btn btn-sm text-dark p-0"
                                    >
                                        <i class="fas fa-heart text-primary mr-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
    <!-- Products End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../../lib/easing/easing.min.js"></script>
    <script src="../../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../js/main.js"></script>
</body>

</html>