<?php
/**
 * Created by PhpStorm.
 * User: Jelle
 * Date: 14-12-2016
 * Time: 11:04
 */
require '../partials/head.php';

$results = $product->getProduct($_GET['product_id']);

?>
    <title>Template</title>
    </head>
    <body>

<?php include '../partials/header.php';?>

    <div class="main-content-products flex jc-sa" style="flex-direction: column">
        <div class="pl-container" style="margin: 0 auto">
            <div class="top flex jc-sb">
                <?php include '../aside.php'; ?>
                <div class="product-overview flex" style="flex-direction: column">
                    <div class="product flex jc-sa">
                        <div class="product-images">
                            <div class="large-image">
                                <img src="<?= $results[0]['product_image_path'] ?>" alt="placeholder">
                            </div>
                        </div>
                        <div class="product-information">
                            <input type="hidden" name="" id="productId" value="<?= $results[0]['product_id'] ?>">
                            <h3><span class="red"></span><?= $results[0]['product_name']?></h3>
                            <p><?=$results[0]['product_description']?></p>
                            <form action="">
                                <div class="form-group">
                                    <label class="sr-only" for="size"></label>
                                    <select class="form-control" id="size">
                                        <option value="">Select size</option>
                                        <?php foreach ($results[1] as $result):?>
                                            <option value="<?=$result['stock_size']?>"><?=$result['stock_size']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="to-cart flex">
                                    <p class="price" id="product-price">€<?= $shoppingCart->roundPrice($results[0]['product_price']) ?></p>
                                    <input onclick="return false" class="btn btn-primary" id="inShoppingCart" type="submit" value="In winkelwagen">
                                </div>
                            </form>
                        </div>
                        <div class="message-shop-cart alert alert-success">
                            <h4 class="alert shop-cart-message-text"></h4>
                        </div>
                    </div>
                    <div class="relevant-items">
                        <h3 style="color: white">relevant products</h3>
                        <?php
                        $relevant = $shoppingCart->relevantProducts($_GET['product_id'], $results[0]['fk_product_cat_id']);
                        foreach ($relevant as $product): ?>
                            <div class="relevant-item col-md-3">
                                <a href="http://valmbeer.badge-webdevelopment.nl/public/shop/product.php?product_id=<?= $product['product_id'] ?>">
                                    <img class="img-responsive" src="<?= $product['product_image_path'] ?>" alt="">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php require '../partials/footer.php'?>
    <?php require '../partials/foot.php'?>
