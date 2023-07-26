<?php
include('../conn.php');

$rentals = $conn->query("SELECT * FROM `rentals` WHERE `member_id` = '".$_SESSION["id"]."' AND `status` = 'รอชำระเงิน'");

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
                <h3>รายการเช่าชุดรอชำระเงิน</h3>
            </div>

            <div class="col-lg-12">
                <br><br>
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ลำดับ</th>
                        <th>หมายเลขออเดอร์</th>
                        <th>วันที่สั่ง</th>
                        <th>ราคารวม</th>
                        <th>สถานะ</th>
                        <th>ตัวเลือก</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($rentals as $key => $row): ?>
                        
                        <?php
                            $rental_details = $conn->query("SELECT SUM((`price_on_rental_date`*`total`)+(`deposit_on_rental_date`*`total`)) AS totalAll FROM `rental_details` WHERE `rental_id` = '".$row['rental_id']."'");
                            $totalAll = $rental_details->fetch_array();
                        ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $row['rental_id']?><?= date("dmY", strtotime($row["rental_date"]))?></td>
                            <td><?= date("d-m-Y", strtotime($row["rental_date"]))?></td>
                            <td><?= number_format($totalAll['totalAll'],2) ?></td>
                            <td><?= $row['status']?></td>
                            <td>
                                <a href="form_Payments.php?id=<?= $row['rental_id'] ?>" class="btn btn-success"> 
                                    <i class="fas fa-cash-register"></i> ชำระเงิน
                                </a>                                
                                <a href="delete_rental.php?id=<?= $row['rental_id'] ?>" class="btn btn-danger">    <i class="fas fa-trash-alt"></i> ยกเลิกการสั่งซื้อ
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