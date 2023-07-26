<?php
include('../conn.php');

$products = $conn->query("SELECT * FROM `products` WHERE `product_id` = '".$_GET['id']."'");
$row = $products->fetch_array();

$clothingtype_products = $conn->query("SELECT * FROM `products` WHERE `clothingtype_id` = '".$row['clothingtype_id']."' AND `product_id` != '".$_GET['id']."' ORDER BY `product_id` DESC LIMIT 4");
$row_count_list = $clothingtype_products->num_rows;

if(isset($_SESSION["id"]) AND $_SESSION["id"] != ""){
    $sql = $conn->query("SELECT * FROM `Favorites` WHERE `member_id` = '".$_SESSION["id"]."' AND `product_id` = '".$_GET['id']."'");
    $row_count_detail = $sql->num_rows;
}else{
    $row_count_detail = 0;
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
    <style>
        #container1 {
          /*box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.3);
          height: 500px;
          width: 500px*/;
          overflow: hidden;
        }

        #container2 {
          /*box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.3);
          height: 500px;
          width: 500px*/;
          overflow: hidden;
        }

        #container3 {
          /*box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.3);
          height: 500px;
          width: 500px*/;
          overflow: hidden;
        }

        #container4 {
          /*box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.3);
          height: 500px;
          width: 500px*/;
          overflow: hidden;
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


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <center>
                        <div class="carousel-item active">
                            <div id="container1">
                            <img 
                                class="w-50 h-50" 
                                src="uploads/<?= $row['product_image1']?>" 
                                alt="Image"
                                id="img1"
                            >
                            </div>
                        </div>
                        <?php if($row['product_image2'] != "" ){?>
                        <div class="carousel-item">
                            <div id="container2">
                            <img 
                                class="w-50 h-50" 
                                src="uploads/<?= $row['product_image2']?>" 
                                alt="Image"
                                id="img2"
                            >
                            </div>
                        </div>
                        <?php }?>
                        <?php if($row['product_image3'] != "" ){?>
                        <div class="carousel-item">
                            <div id="container3">
                            <img 
                                class="w-50 h-50" 
                                src="uploads/<?= $row['product_image3']?>" 
                                alt="Image"
                                id="img3"
                            >
                            </div>
                        </div>
                        <?php }?>
                        <?php if($row['product_image4'] != "" ){?>
                        <div class="carousel-item">
                            <div id="container4">
                            <img 
                                class="w-50 h-50" 
                                src="uploads/<?= $row['product_image4']?>" 
                                alt="Image"
                                id="img4"
                            >
                            </div>
                        </div>
                        <?php }?>  
                        </center>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold"><?= $row['product_name']?></h3>
                <h3 class="font-weight-semi-bold mb-4">
                    ราคา : <?= number_format($row['product_price'],2)?> บาท / วัน
                </h3>

                <p class="mb-4"><?= $row['product_detail']?></p>
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">ขนาด:</p>
                    <p class="mb-0 mr-3">
                        <?= $row['product_size']?>
                    </p>
                    
                </div>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <!-- <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus" >
                            <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div> -->
                    <a 
                        href="../rentals/save_rentals.php?id=<?= $row['product_id'] ?>&status=เพิ่มลงตระกร้า" 
                        class="btn btn-primary px-3"
                        style="margin-right: 2%;"
                    >
                        <i class="fa fa-shopping-cart mr-1"></i> เพิ่มลงตะกร้า
                    </a>
                    <a 
                        href="../rentals/save_rentals.php?id=<?= $row['product_id'] ?>&status=ซื้อสินค้า" 
                        class="btn btn-success px-3"
                        style="margin-right: 2%;"
                    >
                        <i class="fa fa-shopping-cart mr-1"></i> ซื้อสินค้า
                    </a>
                    <?php if($row_count_detail > 0){ ?>
                    <a 
                        href="../Favorites/delete_Favorite.php?id=<?= $_GET['id'] ?>" 
                        class="btn btn-sm text-dark p-0"
                    >
                        <i class="fas fa-heart text-primary mr-1"></i>
                    </a>
                    <?php }else{ ?>
                    <a 
                        href="../Favorites/save_Favorite.php?id=<?= $_GET['id'] ?>" 
                        class="btn btn-sm text-dark p-0"
                    >
                        <i class="far fa-heart"></i>
                    </a>
                    <?php } ?>
                </div>


            </div>
        </div>
       
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <?php if($row_count_list > 0){?>
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">รายการสินค้าประเภทเดียวกัน</span></h2>
        </div>
        
        <div class="row px-xl-5">
            <?php foreach ($clothingtype_products as $key => $value) { ?>
            <div class="col-lg-3">
                <div class="">
                    <?php
                        if(isset($_SESSION["id"]) AND $_SESSION["id"] != ""){
                            $sql = $conn->query("SELECT * FROM `Favorites` WHERE `member_id` = '".$_SESSION["id"]."' AND `product_id` = '".$value['product_id']."'");
                            $row_count = $sql->num_rows;
                        }else{
                            $row_count = 0;
                        }

                    ?>
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <a 
                                href="detail_product.php?id=<?= $value['product_id'] ?>" 
                                class="btn btn-sm text-dark p-0"
                            >
                            <img class="img-fluid w-100" src="uploads/<?= $value['product_image1']?>" alt="">
                            </a>
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3"><?= $value['product_name']?></h6>
                            <div class="d-flex justify-content-center">
                                <h6>ราคา : <?= number_format($value['product_price'],2)?> บาท / วัน</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a 
                                href="detail_product.php?id=<?= $value['product_id'] ?>" 
                                class="btn btn-sm text-dark p-0"
                            >
                                <i class="fas fa-eye text-primary mr-1"></i>
                                ดูรายละเอียด
                            </a>
                            <a 
                                href="../rentals/save_rentals.php?id=<?= $value['product_id'] ?>"
                                class="btn btn-sm text-dark p-0"
                            >
                                <i class="fas fa-shopping-cart text-primary mr-1"></i>
                                เพิ่มลงตระกร้า
                            </a>
                            <?php if($row_count > 0){ ?>
                                <a 
                                    href="../Favorites/delete_Favorite.php?id=<?= $value['product_id'] ?>" 
                                    class="btn btn-sm text-dark p-0"
                                >
                                    <i class="fas fa-heart text-primary mr-1"></i>
                                </a>
                                <?php }else{ ?>
                                <a 
                                    href="../Favorites/save_Favorite.php?id=<?= $value['product_id'] ?>" 
                                    class="btn btn-sm text-dark p-0"
                                >
                                    <i class="far fa-heart"></i>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
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
    <script type="text/javascript">
        const container = document.getElementById("container1");
        const img = document.getElementById("img1");
        container.addEventListener("mousemove", onZoom);
        container.addEventListener("mouseover", onZoom);
        container.addEventListener("mouseleave", offZoom); 

        const container2 = document.getElementById("container2");
        const img2 = document.getElementById("img2");
        container2.addEventListener("mousemove", onZoom);
        container2.addEventListener("mouseover", onZoom);
        container2.addEventListener("mouseleave", offZoom);
        
        const container3 = document.getElementById("container3");
        const img3 = document.getElementById("img3");
        container3.addEventListener("mousemove", onZoom);
        container3.addEventListener("mouseover", onZoom);
        container3.addEventListener("mouseleave", offZoom);

        const container4 = document.getElementById("container4");
        const img4 = document.getElementById("img4");
        container4.addEventListener("mousemove", onZoom);
        container4.addEventListener("mouseover", onZoom);
        container4.addEventListener("mouseleave", offZoom);

        function onZoom(e) {
            const x = e.clientX - e.target.offsetLeft;
            const y = e.clientY - e.target.offsetTop;
            img.style.transformOrigin = `${x}px ${y}px`;
            img.style.transform = "scale(2.5)";

            const x2 = e.clientX - e.target.offsetLeft;
            const y2 = e.clientY - e.target.offsetTop;
            img2.style.transformOrigin = `${x2}px ${y2}px`;
            img2.style.transform = "scale(2.5)";

            const x3 = e.clientX - e.target.offsetLeft;
            const y3 = e.clientY - e.target.offsetTop;
            img3.style.transformOrigin = `${x3}px ${y3}px`;
            img3.style.transform = "scale(2.5)";

            const x4 = e.clientX - e.target.offsetLeft;
            const y4 = e.clientY - e.target.offsetTop;
            img4.style.transformOrigin = `${x4}px ${y4}px`;
            img4.style.transform = "scale(2.5)";
        }
        function offZoom(e) {
            img.style.transformOrigin = `center center`;
            img.style.transform = "scale(1)";

            img2.style.transformOrigin = `center center`;
            img2.style.transform = "scale(1)";

            img3.style.transformOrigin = `center center`;
            img3.style.transform = "scale(1)";

            img4.style.transformOrigin = `center center`;
            img4.style.transform = "scale(1)";
        }
    </script>
</body>

</html>