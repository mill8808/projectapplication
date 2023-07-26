<?php
$clothing_type = $conn->query("SELECT * FROM `clothing_type`");

?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400&display=swap" rel="stylesheet">

<nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
    
    <a href="" class="text-decoration-none d-block d-lg-none">
        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">ฺB</span>yiira</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0" style="font-size: 18px;">
            <a href="/<?= $projectname ?>/index.php" class="nav-item nav-link">หน้าหลัก</a>
            <?php if((isset($_SESSION["level"])) AND (isset($_SESSION['level']) != "")){?>
            <?php if($_SESSION["level"] == 'admin'){?>
            <a href="/<?= $projectname ?>/pages/users/list_users.php" class="nav-item nav-link">
                ผู้ดูแลระบบ
            </a>
            <a href="/<?= $projectname ?>/pages/members/list_members.php" class="nav-item nav-link">สมาชิก</a>
            <a href="/<?= $projectname ?>/pages/clothing_types/list_clothing_types.php" class="nav-item nav-link">
                ประเภทสินค้า
            </a>
            <a href="/<?= $projectname ?>/pages/products/list_products.php" class="nav-item nav-link">
                ข้อมูลสินค้า
            </a>
            <?php } ?>
            <?php if($_SESSION["level"] == 'member'){?>
            <a href="/<?= $projectname ?>/pages/products/show_list_products.php" class="nav-item nav-link">
                รายการสินค้า
            </a>
            
            <a href="/<?= $projectname ?>/pages/Payments/list_Payments.php" class="nav-item nav-link">
                การสั่งซื้อและการชำระเงิน
            </a>
            <a href="/<?= $projectname ?>/pages/rentals/history_rentals.php" class="nav-item nav-link">
                ประวัติการเช่าสินค้าทั้งหมด
            </a>
            <a href="/<?= $projectname ?>/pages/members/form_member.php?id=<?= $_SESSION["id"] ?>" class="nav-item nav-link">
                แก้ไขข้อมูลส่วนตัว
            </a>
            <?php } ?>
            <?php if($_SESSION["level"] == 'admin'){?>
            <a href="/<?= $projectname ?>/pages/rentals/list_rental_admin.php" class="nav-item nav-link">
                ข้อมูลเช่าสินค้า
            </a>
            <?php } ?>
            
            <?php } ?>
            <?php if((!isset($_SESSION["level"])) AND (isset($_SESSION['level']) == "")){?>
            <a href="/<?= $projectname ?>/pages/products/show_list_products.php" class="nav-item nav-link">
                รายการสินค้า
            </a>
            
            <?php } ?>
            <a href="/<?= $projectname ?>/contact.php" class="nav-item nav-link">ติดต่อ</a>
        </div>
        
    </div>
</nav>