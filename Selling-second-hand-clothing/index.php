<?php 

    require("pages/conn.php");

    if(isset($_GET['id']) AND $_GET['id'] != ""){
        $products = $conn->query("SELECT * FROM `products` WHERE `clothingtype_id` = '".$_GET['id']."'");
    }else{
        $products = $conn->query("SELECT * FROM `products`");
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- title start-->
    <?php include('pages/layouts/title.php')?>
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
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <?php include('pages/layouts/Topbar.php')?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-12">
                <?php include('pages/layouts/Navbar.php')?> 
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="img/carousel-1.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <!-- <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4> -->
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                                    <a 
                                        href="pages/products/show_list_products.php" 
                                        class="btn btn-light py-2 px-3"
                                    >
                                        เลือกซื้อเลย
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="img/carousel-2.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <!-- <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4> -->
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                    <a 
                                        href="pages/products/show_list_products.php" 
                                        class="btn btn-light py-2 px-3"
                                    >
                                        เลือกซื้อเลย
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Products Start -->
    <div class="container-fluid mb-5">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <?php include('pages/layouts/sitebar.php')?> 
                       
            </div>
            <div class="col-lg-9 d-none d-lg-block">
                <div class="container-fluid pt-5">
                    <div class="text-center mb-4">
                        <h2 class="section-title px-5"><span class="px-2">รายการสินค้า</span></h2>
                    </div>
                    <div class="row px-xl-5 pb-3">
                        <?php foreach ($products as $key => $value): ?>
                        <?php
                            if(isset($_SESSION["id"]) AND $_SESSION["id"] != ""){
                                $sql = $conn->query("SELECT * FROM `Favorites` WHERE `member_id` = '".$_SESSION["id"]."' AND `product_id` = '".$value['product_id']."'");
                                $row_count = $sql->num_rows;
                            }else{
                                $row_count = 0;
                            }

                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <a 
                                    href="pages/products/detail_product.php?id=<?= $value['product_id'] ?>" 
                                    class="btn btn-sm text-dark p-0"
                                >
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img 
                                        class="img-fluid w-100" 
                                        src="pages/products/uploads/<?= $value['product_image1']?>" 
                                        alt=""
                                        width="100"
                                    >
                                </div>
                                </a>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <div class="col-lg-12">
                                        <h6 class="text-truncate mb-3" style="color: #a67c00">
                                            <?= $value['product_name']?>
                                                
                                        </h6>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <h6>ราคา : <?= number_format($value['product_price'],2)?> บาท / วัน</h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a 
                                        href="pages/products/detail_product.php?id=<?= $value['product_id'] ?>" 
                                        class="btn btn-sm text-dark p-0"
                                    >
                                        <i class="fas fa-eye text-primary mr-1"></i>ดูรายละเอียด
                                    </a>
                                    <a 
                                        href="pages/rentals/save_rentals.php?id=<?= $value['product_id'] ?>" 
                                        class="btn btn-sm text-dark p-0"
                                    >
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i>เพิ่มลงตระกร้า
                                    </a>
                                    <?php if($row_count > 0){ ?>
                                    <a 
                                        href="pages/Favorites/delete_Favorite.php?id=<?= $value['product_id'] ?>" 
                                        class="btn btn-sm text-dark p-0"
                                    >
                                        <i class="fas fa-heart text-primary mr-1"></i>
                                    </a>
                                    <?php }else{ ?>
                                    <a 
                                        href="pages/Favorites/save_Favorite.php?id=<?= $value['product_id'] ?>" 
                                        class="btn btn-sm text-dark p-0"
                                    >
                                        <i class="far fa-heart"></i>
                                    </a>
                                    <?php } ?>
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
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>