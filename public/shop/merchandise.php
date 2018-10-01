<?php
/**
 * Created by PhpStorm.
 * User: Duck
 * Date: 13/12/2016
 * Time: 12:03
 */
require '../partials/head.php';

$result = $product->getMerchendises('Shirts', 999999999999);

?>


<?php include '../partials/header.php';?>
<div class="main-content-merch flex jc-sa">
    <div class="m-container flex jc-sb">
        <?php include '../aside.php' ?>
        <div class="merch-overview jc-">
            <h2><span class="red">Merch</span>andise<span class="red"> Clothes</span></h2>
            <div class="merch-items flex jc-sa">
                <?php foreach($result as $shirt): ?>
                    <div class="merch-item"><a href="product.php?product_id=<?=$shirt['product_id']?>">
                            <img src="<?= $shirt['product_image_path'] ?>" alt="shirt">
                            <div class="product-description-merch">
                                <img src="../img/icons/line.png" alt="line">
                                <h3><?= $shirt['product_name']?></h3>
                                <p><?= $shirt['product_description'] ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>
