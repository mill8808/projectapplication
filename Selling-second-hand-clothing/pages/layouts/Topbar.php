<?php
if((isset($_SESSION["level"])) AND (isset($_SESSION['level']) != "")){
    $Favorites = $conn->query("SELECT COUNT(`Favorite_id`) AS countTotal FROM `Favorites` WHERE `member_id` = '".$_SESSION['id']."'");
    $contFavorite = $Favorites->fetch_array();

    $Rentals = $conn->query("SELECT COUNT(rental_details.rental_detail_id) AS countLental FROM `rentals` INNER JOIN rental_details ON rentals.rental_id = rental_details.rental_id WHERE rentals.member_id = '".$_SESSION['id']."' AND rentals.status = 'รอยืนยันการเช่าชุด'");
    $contRental = $Rentals->fetch_array();
}
?>
<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <?php if (!isset($_SESSION['id'] )) { ?>
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="/<?= $projectname ?>/pages/manage_login">
                    <i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ
                </a>
                <a class="text-dark px-2" href="/<?= $projectname ?>/pages/manage_login/register.php">
                    <i class="far fa-edit"></i> สมัครสมาชิก
                </a>
            </div>
            <?php }else{ ?>
            <div class="d-inline-flex align-items-center">
                ยินดีต้อนรับเข้าสู่ระบบ <?= $_SESSION["name"] ?>
                 <a class="text-dark px-2" href="/<?= $projectname ?>/pages/manage_login/logout.php">
                    <i class="fas fa-sign-in-alt"></i> ออกจากระบบ
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">By</span>iira</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="/<?= $projectname ?>/pages/products/search_product.php" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" name="product_name" placeholder="ค้นหาสินค้า">
                    <div class="input-group-append">
                        <button class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <?php if((isset($_SESSION["level"])) AND (isset($_SESSION['level']) != "")){?>
        <?php if($_SESSION["level"] != 'admin'){?>
        <div class="col-lg-3 col-6 text-right">
            <a href="/<?= $projectname ?>/pages/Favorites/list_Favorites.php" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge"><?= $contFavorite['countTotal']?></span>
            </a>
            <a href="/<?= $projectname ?>/pages/rentals/list_rentals.php" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge"><?= $contRental['countLental']?></span>
            </a>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
</div>