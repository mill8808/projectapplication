<?php
include('../conn.php');

$rentals = $conn->query("SELECT * FROM `rentals` WHERE `member_id` = '".$_SESSION['id']."' AND `status` != 'ยกเลิกคำสั่งซื้อ' AND `status` != 'รอยืนยันการเช่าชุด' AND `status` != 'รอชำระเงิน' ");

$row = $rentals ->fetch_array();

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
                <h3>ประวัติการเช่าสินค้าทั้งหมด</h3>
            </div>

            <div class="col-lg-12">
                <br><br>
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ-นามสกุลผู้เช่า</th>
                        <th>วันที่สั่ง</th>
                        <th>สถานะ</th>
                        <?php if(!empty($row['status'])){?>
                        <?php if($row['status'] == 'จัดส่งสินค้าเรียบร้อย'){?>
                        <th>หมายเลขติดตามการจัดส่ง</th>
                        <?php } ?>
                        <?php if($row['status'] == 'เรียกรถไปรับสินค้าคืน'){?>
                        <th>หมายเลขติดตามการส่งคืน</th>
                        <?php } ?>
                        <?php } ?>
                        <th>ตัวเลือก</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($rentals as $key => $row): ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $row['namerecive']?></td>
                            <td><?= date("d-m-Y", strtotime($row["rental_date"]))?></td>
                            <td><?= $row['status']?></td>
                            <?php if(($row['status'] == 'จัดส่งสินค้าเรียบร้อย') OR ($row['status'] == 'เรียกรถไปรับสินค้าคืน')){?>
                            <td>
                                <a 
                                    target="_blank"
                                    href="<?= $row['tracking_status'] ?>"
                                    class="ex1"
                                >
                                    <?= $row['tracking_status'] ?>
                                </a>
                            </td>
                            <?php } ?>
                            <td>
                                <a 
                                    class="btn btn-primary" 
                                    href="rental_detailHistory.php?id=<?= $row['rental_id']?>"
                                >
                                    <i class="fas fa-search-plus"></i> ดูรายละเอียดเพิ่มเติม
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