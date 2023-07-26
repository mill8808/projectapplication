<?php
include('../conn.php');

$rentals = $conn->query("SELECT * FROM `rentals` INNER JOIN rental_details ON rentals.rental_id = rental_details.rental_id INNER JOIN products ON rental_details.product_id = products.product_id WHERE rentals.rental_id = '".$_GET['id']."'");
$row = $rentals->fetch_array();


$payments = $conn->query("SELECT * FROM `payments` WHERE `rantal_id` = '".$_GET['id']."'");
$rowpayment = $payments->fetch_array();


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
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-12">
                <?php include('../layouts/Navbar.php')?> 
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">ชำระเงิน</h1>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <div class="row">
                    <div class="form-group row col-sm-5" >
                        <label for="inputEmail3" class="col-sm-4 col-form-label label-weight">
                            หมายเลขออเดอร์ :
                        </label>
                        <div class="col-sm-4">
                            <label for="inputEmail3" class="col-form-label">
                                <?= $row['rental_id']?><?= date("dmY", strtotime($row["rental_date"]))?>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row col-sm-4">
                        <label for="inputEmail3" class="col-sm-3 col-form-label label-weight">วันที่สั่ง :</label>
                        <div class="col-sm-5">
                            <label for="inputEmail3" class="col-form-label">
                                <?= date("d-m-Y", strtotime($row["rental_date"]))?>
                            </label>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group row col-sm-5" >
                        <label for="inputEmail3" class="col-sm-4 col-form-label label-weight">
                            วันที่ต้องการจัดส่ง :
                        </label>
                        <div class="col-sm-7">
                            <label for="inputEmail3" class="col-form-label">
                                <?= date("d-m-Y", strtotime($row["rental_pick_up_date"]))?>
                                เวลาที่จัดส่ง <?= $row["delivery_time"] ?>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row col-sm-5">
                        <label for="inputEmail3" class="col-sm-4 col-form-label label-weight">
                            วันที่ต้องการส่งคืน :
                        </label>
                        <div class="col-sm-7">
                            <label for="inputEmail3" class="col-form-label">
                                <?= date("d-m-Y", strtotime($row["rental_return_date"]))?>
                                เวลาที่ส่งคืน <?= $row["delivery_time"] ?>
                            </label>
                            
                        </div>
                    </div>
                </div>

                <div class="text-left mb-4">
                    <h4 class="section-title px-5"><span class="px-2">รายละเอียดการเช่าชุด</span></h4>
                </div>

                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>ชื่อชุด</th>
                            <th>ราคา</th>
                            <th>ราคามัดจำ<br>(20% ของราคาชุด)</th>
                            <th>จำนวน</th>
                            <th>จำนวนวัน</th>
                            <th>ราคารวม</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php 
                            $sumtotal = 0;
                            $sumprice = 0;
                            $sumdeposit = 0;
                        ?>
                        <?php foreach ($rentals as $key => $value): ?>
                        <?php
                            $datediff = floor((strtotime($value['rental_return_date']) - strtotime($value['rental_pick_up_date']))/ (60 * 60 * 24));
                            $deposit20   = $value['product_deposit'];
                            $sumprice    += ($value['product_price']*$value['total'])*$datediff;
                            $sumdeposit  += $deposit20*$value['total'];
                            // $sumtotal += $value['product_price']+$value['product_deposit'];
                            $sumtotal    += (($value['product_price']*$value['total'])*$datediff)+($deposit20*$value['total']);
                        ?>
                        <tr>
                            <td class="align-middle" align="left">
                                <img src="../products/uploads/<?= $value['product_image1']?>" alt="" style="width: 50px;">
                                <?= $value['product_name']?>
                            </td>
                            <td class="align-middle" align="right">
                                <?= number_format($value['product_price'],2)?>
                            </td>
                            <td class="align-middle" align="right">
                                <?= number_format($deposit20,2)?>
                                <?php //number_format($value['product_deposit'],2)?>
                            </td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <!-- <div class="input-group-btn">
                                        <button 
                                            class="btn btn-sm btn-primary btn-minus" 
                                            onclick="myFunctionRemove(<?= $value['rental_detail_id']?>)" 
                                        >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div> -->
                                    <input 
                                        type="text" 
                                        class="form-control form-control-sm bg-secondary text-center" 
                                        value="<?= $value['total']?>"
                                        id="total_<?= $value['rental_detail_id']?>"
                                        name="total"
                                    >
                                    <!-- <div class="input-group-btn">
                                        <button 
                                            class="btn btn-sm btn-primary btn-plus" 
                                            onclick="myFunctionAdd(<?= $value['rental_detail_id']?>)"
                                        >
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div> -->
                                </div>
                            </td>
                            <td class="align-middle" align="right">
                                <input 
                                    type="text" 
                                    class="form-control form-control-sm bg-secondary text-center"
                                    id="total_date"
                                    value="<?= $datediff ?>" 
                                >
                            </td>
                            <td class="align-middle" align="right">
                                <?= number_format((($value['product_price']*$value['total'])*$datediff)+($deposit20*$value['total']),2)?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="4" align="right">
                                <b>ราคารวมค่าชุด</b>
                            </td>
                            <td align="right">
                                <b><?= number_format($sumprice,2) ?></b>
                            </td>
                            <td align="right">
                                <b>บาท</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right">
                                <b>ราคารวมมัดจำ</b>
                            </td>
                            <td align="right">
                                <b><?= number_format($sumdeposit,2) ?></b>
                            </td>
                            <td align="right">
                                <b>บาท</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right">
                                <b>ราคารวมทั้งหมด</b>
                            </td>
                            <td align="right">
                                <b><?= number_format($sumtotal,2) ?></b>
                            </td>
                            <td align="right">
                                <b>บาท</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" align="right">
                                <font color="red">
                                    หมายเหตุ : เงินค่ามัดจำชุดจะได้รับคืน เมื่อนำชุดมาคืนและตรวจสอบชุดเรียบร้อย
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" align="right">
                                <font color="red">
                                    บริการจัดส่งในพื้นที่ กรุงเทพ และปริมณฑล หรือพื้นที่ที่บริการ Grab เข้าถึงเท่านั้น
                                </font>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>

                <div class="text-left mb-4">
                    <h4 class="section-title px-5"><span class="px-2">ข้อมูลการจัดส่ง</span></h4>
                </div>
                <div class="offset-2">
                <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อ-สกุลผู้รับ :</label>
                        <div class="col-sm-6">
                            <input 
                                type="text" 
                                class="form-control" 
                                id="namerecive" 
                                name="namerecive" 
                                placeholder="ชื่อ-สกุลผู้รับ"
                                value="<?= $row['namerecive'] ?>" 
                                disabled
                            >
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">เบอร์โทร :</label>
                        <div class="col-sm-6">
                            <input 
                                type="text" 
                                class="form-control" 
                                id="telrecive" 
                                name="telrecive" 
                                placeholder="083xxxxxxx"
                                value="<?= $row['telrecive'] ?>" 
                                disabled
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">ที่อยู่ :</label>
                        <div class="col-sm-2">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="addressrecive" 
                                id="addressrecive" 
                                placeholder="ที่อยู่เลขที่"
                                value="<?= $row['addressrecive']?>"
                                disabled
                            >
                           
                        </div>
                        <div class="col-sm-2">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="village" 
                                id="village" 
                                placeholder="หมู่บ้าน/อาคาร"
                                value="<?= $row['village']?>"
                                disabled
                            >
                           
                        </div>
                        <div class="col-sm-2">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="alley" 
                                id="alley" 
                                placeholder="ตรอกซอย"
                                value="<?= $row['alley']?>"
                                disabled
                            >
                           
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">จังหวัด :</label>
                        <div class="col-sm-6">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="province" 
                                id="province" 
                                placeholder="ตรอกซอย"
                                value="<?= $row['province']?>"
                                disabled
                            >
                           
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">เขต/อำเภอ :</label>
                        <div class="col-sm-6">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="amphur" 
                                id="amphur" 
                                placeholder="ตรอกซอย"
                                value="<?= $row['amphur']?>"
                                disabled
                            >
                           
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">ตำบล :</label>
                        <div class="col-sm-6">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="district" 
                                id="district" 
                                placeholder="ตรอกซอย"
                                value="<?= $row['district']?>"
                                disabled
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสไปรษณีย์ :</label>
                        <div class="col-sm-6">
                            <input 
                                type="text" 
                                id="postcode" 
                                name="postcode" 
                                class="form-control" 
                                value="<?= $row['postcode']?>"
                                disabled
                            />
                           
                        </div>
                    </div>
                    </div>
                <br>
                <div class="text-left mb-4">
                    <h4 class="section-title px-5"><span class="px-2">หลักฐานการชำระเงิน</span></h4>
                </div>
                <h5 class="label-weight offset-2">ข้อมูลบัญชีธนาคาร</h5>
                <div class="offset-2">
                <div class="form-group row card col-sm-8">
                    <br>
                    <div class="col-sm-11 offset-1">
                        <div class="row">
                            <div class="col-md-3">
                                ธนาคาร : กสิกรไทย
                            </div>
                            <div class="col-md-4">
                                ชื่อบัญชี : ร้านเช่าชุด
                            </div>
                            <div class="col-md-5">
                                เลขที่บัญชี : 4002456542
                            </div>

                        </div>
                    </div>
                    <br>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">หมายเลขบัญชี<br>โอนเงินค่ามัดจำคืน :</label>
                    <div class="col-sm-6">
                        <input 
                            type="text" 
                            class="form-control" 
                            id="account_return_despoit" 
                            name="account_return_despoit"
                            value="<?= $rowpayment['account_return_despoit']?>"
                            disabled 
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">วันที่โอน :</label>
                    <div class="col-sm-6">
                        <input 
                            type="date" 
                            class="form-control" 
                            id="paydate" 
                            name="paydate"
                            value="<?= $rowpayment['paydate']?>"
                            disabled
                           
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">เวลาที่โอน :</label>
                    <div class="col-sm-6">
                        <input 
                            type="time" 
                            class="form-control" 
                            id="paytime" 
                            name="paytime" 
                            value="<?= $rowpayment['paytime']?>"
                            disabled
                           
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">จำนวนเงินที่โอน :</label>
                    <div class="col-sm-6">
                        <input 
                            type="number" 
                            class="form-control" 
                            id="payamount" 
                            name="payamount" 
                            value="<?= $rowpayment['payamount']?>"
                            disabled
                        >
                       
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">หลักฐานการชำระเงิน :</label>
                    <div class="col-sm-6">
                        <img src="../Payments/uploads/<?= $rowpayment['picture']?>" width="150">
                    </div>
                </div>
                </div>
                <br>
                <div class="offset-9 row">
                    <?php if($_SESSION["level"] == 'admin'){?>
                    <a href="list_rental_admin.php" class="btn btn-warning">
                        <i class="fas fa-arrow-left"></i> ย้อนกลับ
                    </a>
                    <?php }else{?>
                    <a href="history_rentals.php" class="btn btn-warning">
                        <i class="fas fa-arrow-left"></i> ย้อนกลับ
                    </a>
                    <?php }?>
                    <?php if($_SESSION["level"] == 'admin'){?>
                    <?php if($row['status'] == 'รอจัดส่งชุด'){?>
                    <a href="update_status_rental.php?id=<?= $row['rental_id']?>&status=กำลังจัดเตรียมสินค้า" class="btn btn-success">
                        <i class="fas fa-spinner"></i> จัดเตรียมสินค้า
                    </a>
                    <?php }?>
                    <?php if($row['status'] == 'กำลังจัดเตรียมสินค้า'){?>
                    <!-- Button trigger modal -->
                    <button 
                        type="button" 
                        class="btn btn-success" 
                        data-toggle="modal" 
                        data-target="#exampleModal"
                    >
                        <i class="fas fa-truck-loading"></i> จัดส่งสินค้าเรียบร้อย
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="update_status_rental.php" method="GET">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ข้อมูลหมายเลขติดตามสินค้า</h5>
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
                                    value="จัดส่งสินค้าเรียบร้อย" 
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
                    <?php }?>
                   
                </div>
                <br>

            </div>
            
        </div>
    </div>
    <!-- Cart End -->





    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a> -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../../lib/easing/easing.min.js"></script>
    <script src="../../lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="../../js/main.js"></script>

   <script type="text/javascript" src="AutoProvince.js"></script>

    <script type="text/javascript">
        $('body').AutoProvince({
        PROVINCE:       '#province', // select div สำหรับรายชื่อจังหวัด
        AMPHUR:         '#amphur', // select div สำหรับรายชื่ออำเภอ
        DISTRICT:       '#district', // select div สำหรับรายชื่อตำบล
        POSTCODE:       '#postcode', // input field สำหรับรายชื่อรหัสไปรษณีย์
        arrangeByName:      false // กำหนดให้เรียงตามตัวอักษร
    });

        
    </script>
</body>

</html>