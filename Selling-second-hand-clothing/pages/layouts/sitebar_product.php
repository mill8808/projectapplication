<?php
$clothing_type = $conn->query("SELECT * FROM `clothing_type`");

?>
<a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
    <h6 class="m-0">ประเภทสินค้า</h6>
    <i class="fa fa-angle-down text-dark"></i>
</a>
<nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
        <!-- <div class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown">Dresses <i class="fa fa-angle-down float-right mt-1"></i></a>
            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                <a href="" class="dropdown-item">Men's Dresses</a>
                <a href="" class="dropdown-item">Women's Dresses</a>
                <a href="" class="dropdown-item">Baby's Dresses</a>
            </div>
        </div> -->
        <a 
            href="/<?= $projectname ?>/pages/products/show_list_products.php" 
            class="nav-item nav-link"
        >
            รายการทั้งหมด
            
        </a>
        <?php foreach ($clothing_type as $key => $value): ?>
        <a 
            href="/<?= $projectname ?>/pages/products/show_list_products.php?id=<?= $value['clothingtype_id']?>" 
            class="nav-item nav-link"
        >
            <?= $value['clothingtype_name']?>
            
        </a>
        <?php endforeach ?>
    </div>
</nav>