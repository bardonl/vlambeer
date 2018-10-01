<!-- copy en paste dit wanneer je een nieuwe pagina maakt! -->

<?php require '../partials/head.php'; ?>
<title>Template</title>
</head>
<body>

<?php include '../partials/header.php';?>

<?php

$order = new Order();

$productData = $order->getOrderById($_GET['orderid']);

$totalPrice = 0;

?>

<div class="main-content">

    <div class="container">
        <div class="order-info">

            <?php foreach ($productData as $products):?>

                <div class="shop-cart-product-list">

                    <div class="mx-auto row">
                        <div class="col-md-3 shop-card-product-image">
                            <img src="<?= $products['product_image_path'] ?>" alt="">
                        </div>

                        <div class="col-md-3 flex fd-c jc-c">
                            <a href="http://valmbeer.badge-webdevelopment.nl/public/shop/product.php?product_id=<?= $products['fk_product_id'] ?>"><?= $products['product_name']?> ( <?= $products['fk_stock_size'] ?> )</a>
                        </div>

                        <div class="col-md-2 shop-card-product-price  flex fd-c jc-c">
                            <h3 class="font-weight-normal">€ <?= $shoppingCart->roundPrice($products['product_price']) ?></h3>
                        </div>

                        <div class="col-md-1 shop-card-product-amount mx-auto  flex fd-c jc-c">
                            <div class="input-group">
                                <p class="quantity-cart" style="width: 150%;"><?= $products['quantity'] ?></p>
                            </div>
                        </div>

                        <div class="col-md-2 offset-md-1 flex fd-c jc-c">
                            <p class="font-weight-bold">€ <?= $shoppingCart->roundPrice($products['quantity'] * $products['product_price']) ?></p>
                        </div>
                    </div>
                </div>

                <?php $totalPrice += $products['quantity'] * $products['product_price']; ?>

            <?php endforeach; ?>

            <div class="divider mx-auto"></div>

            <div class="shop-cart-product-pricing">

                <div class="row mx-auto">
                    <div class="offset-md-8 col-md-2">
                        <p class="font-weight-normal">Excl. tax</p>
                    </div>
                    <div class="col-md-2">
                        <p class="font-weight-bold">€ <?= $shoppingCart->roundPrice($totalPrice) ?></p>
                    </div>
                </div>

                <div class="row mx-auto">
                    <div class="offset-md-8 col-md-2">
                        <p class="font-weight-normal">Tax</p>
                    </div>
                    <div class="col-md-2">
                        <p class="font-weight-bold">21%</p>
                    </div>
                </div>

                <div class="row mx-auto"><div class="divider offset-md-8 col-md-4"></div></div>

                <div class="row mx-auto">
                    <div class="offset-md-8 col-md-2">
                        <p class="font-weight-normal">Total (incl tax)</p>
                    </div>
                    <div class="col-md-2">
                        <p class="font-weight-bold">€ <?= $shoppingCart->roundPrice($totalPrice / 100 * 121) ?></p>
                    </div>
                </div>
            </div>
    </div>

</div>
<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>
