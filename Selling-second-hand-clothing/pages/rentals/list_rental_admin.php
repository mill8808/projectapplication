<?php
include('../conn.php');

$rentals = $conn->query("SELECT * FROM `rentals` WHERE `status` != 'ยกเลิกคำสั่งซื้อ' AND `status` != 'รอยืนยันการเช่าชุด' ");

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
                <h3>รายการประวัติการเช่าชุด</h3>
            </div>

            <div class="col-lg-12">
                <br><br>
                <table class="table table-bordered">
                    <thead>
                      <tr align="center">
                        <th>ลำดับ</th>
                        <th>ชื่อ-สกุลผู้เช่า</th>
                        <th>วันที่สั่ง</th>
                        <th>วันที่/เวลา ที่ส่ง</th>
                        <th>วันที่/เวลา ที่คืน</th>
                        <th>สถานะ</th>
                        <th>ติดตามการจัดส่ง</th>
                        <th>ตัวเลือก</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($rentals as $key => $row): ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $row['namerecive']?></td>
                            <td><?= date("d-m-Y", strtotime($row["rental_date"]))?></td>
                            <td>
                                <?= date("d-m-Y", strtotime($row["rental_pick_up_date"]))?><br>
                                เวลา <?= $row["delivery_time"] ?>
                            </td>
                            <td>
                                <?= date("d-m-Y", strtotime($row["rental_return_date"]))?><br>
                                เวลา <?= $row["delivery_time"] ?>
                                    
                            </td>
                            <td><?= $row['status']?></td>
                            <td width="20%">
                                <a 
                                    target="_blank"
                                    href="<?= $row['tracking_status'] ?>"
                                    class="ex1"
                                >
                                    <?= $row['tracking_status'] ?>
                                </a>
                            </td>
                            <td>
                                <a 
                                    class="btn btn-primary" 
                                    href="rental_detailHistory.php?id=<?= $row['rental_id']?>"
                                >
                                    <i class="fas fa-search-plus"></i> ดูรายละเอียดเพิ่มเติม
                                </a>
                                <?php if($row['status'] == 'เรียกรถไปรับสินค้าคืน'){?>
                                    <a href="update_status_rental.php?id=<?= $row['rental_id']?>&status=ได้รับสินค้าคืนเรียบร้อย" class="btn btn-success">
                                        <i class="fas fa-exchange-alt"></i> ได้รับสินค้าคืนเรียบร้อย
                                    </a>
                                <?php } ?>
                                <?php if(($row['status'] == 'จัดส่งสินค้าเรียบร้อย') AND ($row['rental_return_date'] == date("Y-m-d"))){?>
                                <!-- Button trigger modal -->
                                <button 
                                    type="button" 
                                    class="btn btn-success" 
                                    data-toggle="modal" 
                                    data-target="#exampleModal"
                                >
                                    <i class="fas fa-truck-loading"></i> เรียกรถไปรับสินค้าคืน
                                </button>

                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="update_status_rental.php" method="GET">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ข้อมูลหมายเลขติดตามสินค้าคืน</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" 
                                            class="form-control" 
                                            name="tracking_status" 
                                            value="" 
                                            id="tracking_status"
                                        >
                                        <input 
                                            type="hidden" 
                                            class="form-control" 
                                            name="status" 
                                            value="เรียกรถไปรับสินค้าคืน" 
                                            id="status"
                                        >
                                        <input 
                                            type="hidden" 
                                            class="form-control" 
                                            name="id" 
                                            value="<?= $row['rental_id']?>" 
                                            id="id"
                                        >
                                    </div>
                                    <div class="modal-footer">
                                        <button 
                                            type="button" 
                                            class="btn btn-secondary" 
                                            data-dismiss="modal"
                                        >
                                            ปิด
                                        </button>
                                        <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                                <?php }?>
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