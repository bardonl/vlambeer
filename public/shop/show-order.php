<!-- copy en paste dit wanneer je een nieuwe pagina maakt! -->

<?php require '../partials/head.php';

if($user->loggedIn == false) {
    $user->redirect('login.php');
    die;
}

if($shoppingCart->checkUserHasActiveShopCart($user->userId) == 0) {
    $user->redirect('index.php');
}

$userDataX = $user->getUserDataById($user->userId);
foreach ($userDataX as $key => $val) {

    if($key == 'firstname' || $key == 'lastname' || $key == 'profile_picture_path' || $key == 'mobilenumber' || $key == 'phonenumber')

   if(empty($val)) {
       $user->redirect('profile/edit_profile.php');
       die;
   }
}



$cartId = $shoppingCart->getCartByUserId($user->userId);

$productData = $shoppingCart->getCartProducts($user->userId);
$totalPrice = $shoppingCart->getCartTotalPrice($cartId);
?>
<title></title>
</head>
<body>

<?php include '../partials/header.php';?>

<div class="main-content check-order">

    <div class="container">
        <div class="user-order-info">
            <div class="user-info-left">
                <h3>User info</h3>
                Name: <?= $userDataX['firstname'] . ' ' . $userDataX['lastname'] ?><br>
                Gender: <?= ($userDataX['user_gender'] == 1 ? 'male': 'female') ?><br>
                Mobile number: <?= $userDataX['mobilenumber'] ?><br>
                Email: <?= $userDataX['email'] ?><br>
            </div>
            <div class="user-info-right">
                <h3>Address</h3>
                <?= $userDataX['streetname'] . ' ' . $userDataX['housenumber'] ?><br>
                <?= $userDataX['zipcode'] . ' ' . $userDataX['city'] ?><br>
                <?= $userDataX['state_or_province'] . ' ' . $userDataX['country'] ?><br>
            </div>
        </div>
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
            <?php endforeach; ?>

            <div class="divider mx-auto"></div>

            <div class="shop-cart-product-pricing">

                <div class="row mx-auto">
                    <div class="offset-md-8 col-md-2">
                        <p class="font-weight-normal">Excl. tax</p>
                    </div>
                    <div class="col-md-2">
                        <p class="font-weight-bold">€ <?= $shoppingCart->roundPrice($shoppingCart->getCartTotalPrice($shoppingCart->getCartByUserId($user->userId))) ?></p>
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
                        <p class="font-weight-bold">€ <?= $shoppingCart->roundPrice($shoppingCart->getCartTotalPrice($shoppingCart->getCartByUserId($user->userId)) / 100 * 121) ?></p>
                    </div>
                </div>

                <div class="row mx-auto">
                    <div class=" offset-md-9 col-md-2">
                        <label>accept order</label>


                        <input type="checkbox" id="accept-order">
                    </div>

                    <div class="offset-md-10 col-md-2">
                        <a disabled type="button" class="btn btn-primary" id="unload-shop-cart">Pay</a>

                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="upload" value="1">
                            <input type="hidden" name="business" value="kobus.haarhuis-facilitator@hotmail.com">

                            <input type="hidden" name="currency_code" value="EUR">







                            <?php
                            $counter = 1;
                            foreach ($productData as $products):?>
                                <input type="hidden" name="item_name_<?=$counter?>" value="<?= $products['product_name']?>( <?= $products['fk_stock_size'] ?> )">
                                <input type="hidden" name="item_number_<?=$counter?>" value="<?=$counter?>">
                                <input type="hidden" name="quantity_<?=$counter?>" value="<?= $products['quantity'] ?>">
                                <input type="hidden" name="amount_<?=$counter?>" value="<?=$products['product_price']?>">
                                <input type="hidden" name="tax_rate_<?=$counter?>" value="21.000">
                            <?php
                            $counter++;

                            endforeach; ?>

                            <input type="image" src="http://www.sandbox.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>
<script>
    $(document).ready(function () {
        winkelWagen.loadShoppingCart();
        (function($) {
            $.fn.toggleDisabled = function() {
                return this.each(function() {
                    var $this = $(this);
                    if ($this.attr('disabled')) $this.removeAttr('disabled');
                    else $this.attr('disabled', 'disabled');
                });
            };
        })(jQuery);

        $('#accept-order:checkbox').change(function () {
            $('#unload-shop-cart').toggleDisabled();
        })
    })
</script>