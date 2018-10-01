<?php require '../partials/head.php' ?>
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

<link rel="stylesheet" href="../css/timkt.css">
<?php include '../partials/header.php';

if($user->loggedIn == false) {
    $user->redirect('login.php');
    die;
}

if($shoppingCart->checkUserHasActiveShopCart($user->userId) == 0) {
    $user->redirect('index.php');
    die;
}
?>

<div class="shop-cart-main mx-auto">
    <div class="container">
        <div class="shop-cart-main-content mx-auto">
            <div class="row">
                <h1 class="mx-auto">Shopping Cart</h1>
            </div>

            <div class="shop-cart-load">

            </div>

            
        </div>
    </div>
</div>

<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>
<script>
    $(document).ready(function() {
        winkelWagen.loadShoppingCart();
        winkelWagen.updateShopCart();
        winkelWagen.updateNumber();
    });
</script>