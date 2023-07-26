<?php 
    
  require("../conn.php");
  $clothing_types = $conn->query("SELECT * FROM `clothing_type`");

  $product_id            = "";
  $clothingtype_id       = "";
  $product_name          = "";
  $product_detail        = "";
  $product_price         = "";
  $product_total         = 0;
  $product_deposit       = "";
  $product_size          = "";
  $product_image1        = "";
  $product_image2        = "";
  $product_image3        = "";
  $product_image4        = "";


  if(isset($_GET["id"])) {
    $sql = "SELECT * FROM products WHERE product_id = ".$_GET["id"]." ";
    $result = $conn->query($sql);
    $row = $result->fetch_array();

    $product_id             = $_GET["id"];
    $clothingtype_id        = $row["clothingtype_id"];
    $product_name           = $row["product_name"];
    $product_detail         = $row["product_detail"];
    $product_price          = $row["product_price"];
    $product_total          = 0;
    $product_deposit        = $row["product_deposit"];
    $product_size           = $row["product_size"];
    $product_image1         = $row["product_image1"];
    $product_image2         = $row["product_image2"];
    $product_image3         = $row["product_image3"];
    $product_image4         = $row["product_image4"];

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
                <?php if($product_id != ""){?>
                    <h3>แบบฟอร์มแก้ไขข้อมูลสินค้า</h3>
                <?php }else{?>
                    <h3>แบบฟอร์มเพิ่มข้อมูลสินค้า</h3>
                <?php }?>
            </div>

            <div class="col-lg-12">
                <form action="save_product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                
                <br><br>
                    <div class="mb-3">
                      <label for="product_name" class="form-label">ชื่อสินค้า</label>
                      <input type="text" class="form-control" id="product_name" placeholder="ชื่อสินค้า" name="product_name" value="<?= $product_name ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="clothingtype_id" class="form-label">ประเภทสินค้า</label>
                        <select name="clothingtype_id" id="clothingtype_id" class="form-control">
                            <?php foreach ($clothing_types as $key => $value): ?>
                            <?php if($value['clothingtype_id'] == $clothingtype_id){?>
                            <option value="<?= $value['clothingtype_id']?>" selected>
                                <?= $value['clothingtype_name']?>
                                    
                            </option>
                            <?php }else{ ?>
                            <option value="<?= $value['clothingtype_id']?>">
                                <?= $value['clothingtype_name']?>
                                    
                            </option>
                            <?php } ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                      <label for="product_price" class="form-label">ราคาเช่า</label>
                      <input type="text" class="form-control" id="product_price" placeholder="ราคาเช่า" name="product_price" value="<?= $product_price ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="product_price" class="form-label">ราคามัดจำ</label>
                      <input type="text" class="form-control" id="product_deposit" placeholder="ราคามัดจำ" name="product_deposit" value="<?= $product_deposit ?>" required>
                    </div>
                   <!--  <div class="mb-3">
                      <label for="product_deposit" class="form-label">ราคามัดจำ</label>
                      <input type="text" class="form-control" id="product_deposit" placeholder="1000" name="product_deposit" value="<?= $product_deposit ?>" required>
                    </div> -->
                    <!-- <div class="mb-3">
                      <label for="product_total" class="form-label">จำนวน</label>
                      <input type="text" class="form-control" id="product_total" placeholder="10" name="product_total" value="<?= $product_total ?>" required>
                    </div> -->
                    <div class="mb-3">
                      <label for="product_size" class="form-label">ขนาด</label>
                      <input type="text" class="form-control" id="product_size" placeholder="ขนาด" name="product_size" value="<?= $product_size ?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="product_detail" class="form-label">รายละเอียด</label>
                      <textarea class="form-control" id="product_detail" name="product_detail" rows="3"><?= $product_detail ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="product_image1" class="form-label">รูปที่ 1</label>
                        <input 
                            type="file" 
                            class="form-control" 
                            id="product_image1" 
                            name="product_image1" 
                            value="<?= $product_image1 ?>"
                        >
                        <input 
                            type="hidden" 
                            class="form-control" 
                            id="product_image1_old" 
                            name="product_image1_old" 
                            value="<?= $product_image1 ?>"
                        >
                        <?php if($product_image1 != ""){ ?>
                            <br>
                            <label for="product_image1" class="form-label">รูปที่ 1 เดิม</label>
                            <br>
                            <img src="uploads/<?= $product_image1 ?>" width="150">
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="product_image2" class="form-label">รูปที่ 2</label>
                        <input 
                            type="file" 
                            class="form-control" 
                            id="product_image2" 
                            name="product_image2" 
                            value="<?= $product_image2 ?>"
                        >
                        <input 
                            type="hidden" 
                            class="form-control" 
                            id="product_image2_old" 
                            name="product_image2_old" 
                            value="<?= $product_image2 ?>"
                        >
                        <?php if($product_image2 != ""){ ?>
                            <br>
                            <label for="product_image1" class="form-label">รูปที่ 2 เดิม</label>
                            <br>
                            <img src="uploads/<?= $product_image2 ?>" width="150">
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="product_image3" class="form-label">รูปที่ 3</label>
                        <input 
                            type="file" 
                            class="form-control" 
                            id="product_image3" 
                            name="product_image3" 
                            value="<?= $product_image3 ?>"
                        >
                        <input 
                            type="hidden" 
                            class="form-control" 
                            id="product_image3_old" 
                            name="product_image3_old" 
                            value="<?= $product_image3 ?>"
                        >
                        <?php if($product_image3 != ""){ ?>
                            <br>
                            <label for="product_image1" class="form-label">รูปที่ 3 เดิม</label>
                            <br>
                            <img src="uploads/<?= $product_image3 ?>" width="150">
                        <?php } ?>
                    </div>
                    <div class="mb-3">
                        <label for="product_image4" class="form-label">รูปที่ 4</label>
                        <input 
                            type="file" 
                            class="form-control" 
                            id="product_image4" 
                            name="product_image4" 
                            value="<?= $product_image4 ?>"
                        >
                        <input 
                            type="hidden" 
                            class="form-control" 
                            id="product_image4_old" 
                            name="product_image4_old" 
                            value="<?= $product_image4 ?>"
                        >
                        <?php if($product_image4 != ""){ ?>
                      
                            <br>
                            <label for="product_image1" class="form-label">รูปที่ 4 เดิม</label>
                            <br>
                            <img src="uploads/<?= $product_image4 ?>" width="150">
                        <?php } ?>
                    </div>

                    <div class="offset-10 row">
                        <a href="list_products.php" class="btn btn-warning">
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