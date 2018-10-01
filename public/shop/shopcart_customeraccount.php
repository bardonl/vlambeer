<?php require '../partials/head.php' ?>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<?php include '../partials/header.php';

if($user->loggedIn == true) {
    $user->redirect('index.php');
    die;
}

?>
<link rel="stylesheet" href="../css/timkt.css">


<div class="shop-cart-main mx-auto">
    <div class="container">
        <div class="shop-cart-main-content mx-auto">
            <div class="row">
                <h1 class="mx-auto">Log in to continue</h1>
            </div>
            <div class="row">
                <div class="user-account existing-user offset-md-1 col-md-4">
                    <h2>Existing user</h2>
                    <form action="<?= BASE_URL ?>app/controllers/authControl.php" method="post">
                        <div class="form-group">
                            <label for="username" class="sr-only"></label>
                            <i class="fa fa-user fa-lg" aria-hidden="true"></i>
                            <input type="text" name="username" id="emailadress" style="padding-left: 35px" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only"></label>
                            <i class="fa fa-lock" aria-hidden="true"></i>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <input type="submit" value="Log in" name="login" class="btn btn-primary">
                        <a class="offset-md-1" href="">Forgot password?</a>
                        <input type="hidden" name="webshop" value="login">
                    </form>
                </div>
                <div class="divider-vertical col-md-1"></div>
                <div class="user-account offset-md-1 col-md-4">
                    <h2>New user</h2>
                    <form action="shopcart_customerinfo.php" method="post">
                        <div class="form-group">
                            <label for="emailadress" class="sr-only"></label>
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            <input type="email" name="email-filled" id="emailadress" class="form-control" placeholder="Emailadress">
                        </div>
                        <input type="submit" value="Continue as a new user" class="btn btn-primary">
                        
                    </form>
                </div>
            </div>
            <div class="row">
                <a href="" class="offset-md-1 col-md-4">
                    <i class="glyphicon glyphicon-menu-left"></i>
                    Go back to the shopping cart
                </a>
            </div>
        </div>
    </div>
</div>

<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>
