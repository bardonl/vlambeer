<?php require_once realpath(__DIR__ . '/../init.php');


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['shoppingCart'])) {
        
        if($_POST['shoppingCart'] == 'delete') {

            $shoppingCart->removeFromCart($_POST['shopCartId'], $_POST['productId'], $_POST['size']);

        }
        
        if($_POST['shoppingCart'] == 'updateShopCartInfo') {
            
            // shopping cart 
            if($shoppingCart->checkUserHasActiveShopCart($user->userId) == 1
                && $shoppingCart->checkCartHasItems($shoppingCart->getCartByUserId($user->userId)) == 1):  ?>
                <div class="shop-cart-product-list-names">
                    <div class="mx-auto row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3"><h2>Description</h2></p></div>
                        <div class="col-md-2"><h2>Price</h2></div>
                        <div class="col-md-2"><h2>Amount</h2></div>
                        <div class="col-md-2"><h2>Total price</h2></div>
                    </div>
                </div>
                <div class="row divider mx-auto"></div>
                <?php
                $product = $shoppingCart->getCartProducts($user->userId);
                foreach ($product as $products):?>

                    <div class="shop-cart-product-list">

                        <div class="cartIds">
                            <input type="hidden" class="product-id-shop-cart" value="<?= $products['fk_product_id'] ?>">
                            <input type="hidden" class="product-size" value="<?= $products['fk_stock_size'] ?>">
                            <input type="hidden" class="shop-cart-active-id" value="<?= $shoppingCart->getCartByUserId($user->userId) ?>">
                            <input type="hidden" class="product-quantity-cart" value="<?= $products['quantity'] ?>">
                        </div>
                        
                        <div class="mx-auto row">
                            <div class="col-md-3 shop-card-product-image">
                                <img src="<?= $products['product_image_path'] ?>" alt="">
                                <a class="remove-product-from-cart">
                                    <span class="glyphicon glyphicon-remove text-danger"></span>
                                </a>
                            </div>

                            <div class="col-md-3 flex fd-c jc-c">
                                <a href="http://valmbeer.badge-webdevelopment.nl/public/shop/product.php?product_id=<?= $products['fk_product_id'] ?>"><?= $products['product_name']?> ( <?= $products['fk_stock_size'] ?> )</a>
                            </div>

                            <div class="col-md-2 shop-card-product-price  flex fd-c jc-c">
                                <h3 class="font-weight-normal">€ <?= $shoppingCart->roundPrice($products['product_price']) ?></h3>
                            </div>

                            <div class="col-md-1 shop-card-product-amount mx-auto  flex fd-c jc-c">
                                <div class="input-group">
                                    <input class="form-control quantity-cart" style="width: 150%;" type="number" value="<?= $products['quantity'] ?>">
                                </div>
                            </div>

                            <div class="col-md-2 offset-md-1 flex fd-c jc-c">
                                <h3 class="font-weight-bold">€ <?= $shoppingCart->roundPrice($products['quantity'] * $products['product_price']) ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <div class="divider mx-auto"></div>

            <div class="shop-cart-product-pricing">

                <div class="row mx-auto">
                    <div class="offset-md-8 col-md-2">
                        <h3 class="font-weight-normal">Excl. tax</h3>
                    </div>
                    <div class="col-md-2">
                        <h3 class="font-weight-bold">€ <?= $shoppingCart->roundPrice($shoppingCart->getCartTotalPrice($shoppingCart->getCartByUserId($user->userId))) ?></h3>
                    </div>
                </div>

                <div class="row mx-auto">
                    <div class="offset-md-8 col-md-2">
                        <h3 class="font-weight-normal">Tax</h3>
                    </div>
                    <div class="col-md-2">
                        <h3 class="font-weight-bold">21%</h3>
                    </div>
                </div>

                <div class="row mx-auto"><div class="divider offset-md-8 col-md-4"></div></div>

                <div class="row mx-auto">
                    <div class="offset-md-8 col-md-2">
                        <h3 class="font-weight-normal">Total (incl tax)</h3>
                    </div>
                    <div class="col-md-2">
                        <h3 class="font-weight-bold">€ <?= $shoppingCart->roundPrice($shoppingCart->getCartTotalPrice($shoppingCart->getCartByUserId($user->userId)) / 100 * 121) ?></h3>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="offset-md-10 col-md-2">
                        <a class="btn btn-primary" id="unload-shop-cart" href="http://valmbeer.badge-webdevelopment.nl/public/shop/show-order.php">Checkout</a>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="empty-shop-cart">
                <img src="http://valmbeer.badge-webdevelopment.nl/public/img/icons/shopping-cart.png">
                <p>Your shopping cart is empty</p>
                <a href="http://valmbeer.badge-webdevelopment.nl/public/shop/games.php" class="btn btn-primary">start shopping!</a>
            </div>
            <?php endif;
        }
        
        if($_POST['shoppingCart'] == 'add-product') {

            if($user->loggedIn == false) {
                echo 'error';
                die;
            }

            foreach ($_POST as $key => $val) {

                if (empty($val)) {
                    echo 'error';
                    die;
                }
            }
            $shoppingCart->addProductToShoppingCart($user->userId, $_POST['product_id'], $_POST['quantity'], $_POST['size']);

            echo 'success';
        }

        if($_POST['shoppingCart'] == 'updateCart'):?>
            <?php if($shoppingCart->checkUserHasActiveShopCart($user->userId) == 1
                && $shoppingCart->checkCartHasItems($shoppingCart->getCartByUserId($user->userId)) == 1):  ?>
            <?php foreach ($shoppingCart->getCartProducts($user->userId) as $products):?>
                <div class="product-preview-info">
                    <p><?= $products['quantity'] ?> X </p>
                    <div class="product-name-preview">
                        <p><a href="http://valmbeer.badge-webdevelopment.nl/public/shop/product.php?product_id=<?= $products['fk_product_id'] ?>">
                                <?= $products['product_name'] ?> ( <?= $products['fk_stock_size'] ?> )
                            </a></p>
                        <p><?= $products['product_cat_desc'] ?></p>
                    </div>
                    <div class="product-preview-price">
                        <p>&#8364 <?= $shoppingCart->roundPrice($products['product_price']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="total-price">
                <h4>Total:</h4><h4>&#8364 <?= $shoppingCart->roundPrice($shoppingCart->getCartTotalPrice($shoppingCart->getCartByUserId($user->userId))) ?></h4>
            </div>
            <a class="btn btn-primary" href="<?= BASE_URL ?>public/shop/shopcart.php">Afrekenen</a>
            <?php else: ?>
                <div class="empty-shop-cart">
                    <img src="<?= BASE_URL ?>public/img/icons/shopping-cart.png">
                    <p>Your shopping cart is empty</p>
                </div>
                <a href="<?= BASE_URL ?>public/shop/games.php" class="btn btn-primary">start shopping!</a>
        <?php endif;
        endif;
        
        if($_POST['shoppingCart'] == 'updateNum'):
            if($shoppingCart->checkCartHasItems($shoppingCart->getCartByUserId($user->userId)) == 1):
            ?>

            <i><?= $shoppingCart->getTotalItems($shoppingCart->getCartByUserId($user->userId)) ?></i>

        <?php
            else:
                echo 'remove';
            endif;
        endif;
        
        if($_POST['shoppingCart'] == 'edit') {
            foreach ($_POST as $item) {
                echo $item;
            }
            $shoppingCart->changeQuantity($_POST['shopCartId'], $_POST['productId'], $_POST['size'], $_POST['quantity']);
        }
        
        if($_POST['shoppingCart'] == 'unload') {
            $order->createOrder( $user->userId);

            $productData = $shoppingCart->getCartProducts($user->userId);

            foreach ($productData as $item) {
                $order->productsToOrder($order->getLastOrderOfUser(
                    $user->userId), $item['quantity'], $item['fk_stock_size'], $item['fk_product_id']);
            }

            $shoppingCart->setAllActiveToNull($user->userId);

            echo BASE_URL . 'public/shop/order_success.php';


        }
        
        if($_POST['shoppingCart'] == 'changeOrderStatus') {
            
            $order->editOrderStatus($_POST['orderId'], $_POST['orderStatus']);
            
        }
    }
}