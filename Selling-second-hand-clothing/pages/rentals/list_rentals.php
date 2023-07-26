<?php
include('../conn.php');

$rentals = $conn->query("SELECT * FROM `rentals` INNER JOIN rental_details ON rentals.rental_id = rental_details.rental_id INNER JOIN products ON rental_details.product_id = products.product_id WHERE rentals.member_id = '".$_SESSION["id"]."' AND rentals.status = 'รอยืนยันการเช่าชุด'");
$row = $rentals->fetch_array();

$total_daydiff = 0;
$checkstatus15 = "";
$checkstatus10 = "";
$checkstatus7  = "";
$checkstatus3  = "";

if (!empty($row['rental_return_date'])) {
   $datediff = strtotime($row['rental_return_date']) - strtotime($row['rental_pick_up_date']);  
   $total_daydiff = floor($datediff / (60 * 60 * 24));
}



if ($total_daydiff == '15') {
    $checkstatus15 = 'checked';
}elseif($total_daydiff == '10'){
    $checkstatus10 = 'checked';
}elseif($total_daydiff == '7'){
    $checkstatus7 = 'checked';
}else{
    $checkstatus3 = 'checked';
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
    <style type="text/css">
        #delivery_time:before {
            content: 'ระบุเวลาจัดส่ง :';
            margin-right: .6em;
            color: #9d9d9d;
            
/*            background: #fff;*/
/*            position: absolute;*/
        }

        /*#timepicker:before {
           content: 'เวลาส่งคืน :';
           margin-right: .6em;
           color: #9d9d9d;
           background: #e9ecef;
           position: absolute;
        }
*/
       /* #delivery_time:focus:before {
            width: 0;
            content: '';
        }*/

       /* #timepicker:focus:before {
            width: 0;
            content: '';
        }*/
    </style>
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">ตะกร้าสินค้า</h1>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <form action="save_confirm_rental.php" method="POST">

        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">

                <div class="row">
                    <div class="col-md-6" >
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">ระบุวันที่ต้องการจัดส่ง :</label>
                            <div class="col-sm-6">
                                <input 
                                    type="date" 
                                    name="rental_pick_up_date" 
                                    class="form-control" 
                                    id="rental_pick_up_date" 
                                    value="<?= $row['rental_pick_up_date'] ?>" 
                                    onchange="getvalue_date()"
                                >
                                <input 
                                    type="hidden" 
                                    name="rental_id" 
                                    class="form-control" 
                                    id="rental_id" 
                                    value="<?= $row['rental_id'] ?>"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input 
                                    type="time" 
                                    name="delivery_time" 
                                    class="form-control"  
                                    id="delivery_time"
                                    onchange="getvalue_date()"
                                    value="<?= $row['delivery_time'] ?>"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-2">จำนวนวันที่ต้องการยืม: </div>
                    <div class="col-md-1">
                        <input 
                            type="radio" 
                            id="total_day3" 
                            name="total_day" 
                            value="3"
                            onclick="getvalue_date()"
                            <?= $checkstatus3 ?> 
                        >
                        <label for="html">3 วัน</label>
                    </div>
                    <div class="col-md-1">
                        <input 
                            type="radio" 
                            id="total_day7" 
                            name="total_day" 
                            value="7"
                            onclick="getvalue_date()"
                            <?= $checkstatus7 ?>
                        >
                        <label for="html">7 วัน</label>
                    </div>
                    <div class="col-md-1">
                        <input 
                            type="radio" 
                            id="total_day10" 
                            name="total_day" 
                            value="10"
                            onclick="getvalue_date()"
                            <?= $checkstatus10 ?>
                        >
                        <label for="html">10 วัน</label>
                    </div>
                    <div class="col-md-1">
                        <input 
                            type="radio" 
                            id="total_day15" 
                            name="total_day" 
                            value="15"
                            onclick="getvalue_date()"
                            <?= $checkstatus15 ?>
                        >
                        <label for="html">15 วัน</label>
                    </div>
                    
                    
                </div>

                <div class="row">

                    <div class="col-md-6" >
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">วันที่ต้องจัดส่งคืน :</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" id="rental_return_date" value="<?= $row['rental_return_date'] ?>" disabled>
                                <input type="hidden" name="rental_return_date" class="form-control" value="<?= $row['rental_return_date'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="time" name="delivery_time" class="form-control" value="<?= $row['delivery_time'] ?>" disabled id="timepicker">
                            </div>
                        </div>
                    </div>
                </div>


                

                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>ราคามัดจำ</th>
                            <th>จำนวน</th>
                            <th>จำนวนวัน</th>
                            <th>ราคารวม</th>
                            <th>ตัวเลือก</th>
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
                                        disabled
                                    >
                                    <input 
                                        type="hidden" 
                                        class="form-control form-control-sm bg-secondary text-center" 
                                        value="<?= $value['total']?>"
                                        id="total_<?= $value['rental_detail_id']?>_insert"
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
                                    disabled
                                >
                            </td>
                            <td class="align-middle" align="right">
                                <?= number_format((($value['product_price']*$value['total'])*$datediff)+($deposit20*$value['total']),2)?>
                            </td>
                            <td class="align-middle">
                                <button 
                                    class="btn btn-sm btn-primary" 
                                    onclick="myFunctionDelete(<?= $value['rental_detail_id']?>)"
                                >
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="5" align="right">
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
                            <td colspan="5" align="right">
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
                            <td colspan="5" align="right">
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
                            <td colspan="7" align="right">
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
                <div class="offset-9 row">
                    <a href="../products/show_list_products.php" class="btn btn-warning">
                        <i class="fas fa-arrow-left"></i> เลือกซื้อสินค้าเพิ่ม
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> ยืนยันการสั่งซื้อสินค้า
                    </button>
                </div>
                <br>

            </div>
            
        </div>
        </form>
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

    <script>
    function myFunctionRemove(rental_detail_id) {
        // console.log(rental_detail_id)
        
        var total = parseInt(document.getElementById("total_"+rental_detail_id).value) - 1;
        // console.log(total)
        // console.log("total_"+rental_detail_id)
        var jsonObj = {"total":total, "rental_detail_id": rental_detail_id}

        $.ajax({
           type: "POST",
           url: "update_rentals.php",
           data: jsonObj,
           success: function(result) {
            if (result=='success') {
                location.reload();
            }           }
         });
      
    }

    function myFunctionAdd(rental_detail_id) {
        // console.log(rental_detail_id)
        
        var total = parseInt(document.getElementById("total_"+rental_detail_id).value) + 1;
        // console.log(total)
        var jsonObj = {"total":total, "rental_detail_id": rental_detail_id}

        $.ajax({
           type: "POST",
           url: "update_rentals.php",
           data: jsonObj,
           success: function(result) {
            if (result=='success') {
                location.reload();
            }           }
         });
      
    }

    function myFunctionDelete(rental_detail_id) {
        var jsonObj = {"rental_detail_id": rental_detail_id}

        $.ajax({
           type: "POST",
           url: "delete_rental.php",
           data: jsonObj,
           success: function(result) {
            if (result=='success') {
                location.reload();
            }           }
         });
      
    }

    function getvalue_date(){
        rental_pick_up_date = document.getElementById("rental_pick_up_date").value;
        delivery_time = document.getElementById("delivery_time").value;
        total_day3 = document.getElementById("total_day3");
        // rental_return_date = document.getElementById("rental_return_date").value;
        rental_id = document.getElementById("rental_id").value;

        if (total_day15.checked === true) {
            total_day = '15'
        }else if(total_day10.checked === true){
            total_day = '10'
        }else if(total_day7.checked === true){
            total_day = '7'
        }else{
            total_day = '3'
        }

        if (rental_pick_up_date === '') {
            alert("กรุณาระบุวันที่ต้องการจัดส่ง")
        }else{
            var jsonObj = {"rental_id": rental_id, "rental_pick_up_date": rental_pick_up_date, "total_day": total_day, "delivery_time": delivery_time }

            $.ajax({
               type: "POST",
               url: "update_date_rental.php",
               data: jsonObj,
               success: function(result) {
                    // console.log(result)
                    if (result=='success') {
                        location.reload();
                    }
                }
             });
        }
          // console.log("rental_pick_up_date"+rental_pick_up_date)
          // console.log("rental_return_date"+rental_return_date)

          // var result = getDateDiff(rental_pick_up_date, rental_return_date)
          // console.log(result);
          // if (!isNaN(result)) {
          //   document.getElementById("total_date").value = result;
          // }

        

    }

    function getDateDiff(time1, time2) {
      var str1= time1.split('-');
      var str2= time2.split('-');

      // console.log(str1);

      //                yyyy   , mm       , dd
      var t1 = new Date(str1[0], str1[1]-1, str1[2]);
      var t2 = new Date(str2[0], str2[1]-1, str2[2]);

      var diffMS = t2 - t1;    
      // console.log(diffMS + ' ms');

      var diffS = diffMS / 1000;    
      // console.log(diffS + ' ');

      var diffM = diffS / 60;
      // console.log(diffM + ' minutes');

      var diffH = diffM / 60;
      // console.log(diffH + ' hours');

      var diffD = diffH / 24;
      // console.log(diffD + ' days');
      // console.log(diffD);

      return diffD
    }

    </script>
</body>

</html>