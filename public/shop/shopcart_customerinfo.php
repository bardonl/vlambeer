<?php
/**
 * Created by PhpStorm.
 * User: Jelle
 * Date: 16-12-2016
 * Time: 13:54
 */
require '../partials/head.php' ?>
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
                <h1 class="mx-auto">Your account information</h1>
            </div>
            <div class="user-information offset-md-2 col-md-8">
                <form action="<?= BASE_URL ?>app/controllers/authControl.php" method="post">
                    <div class="row">
                        <div class="radio col-md-12">
                            <label>Gender:</label>
                            <label>
                                <input type="radio" name="gender" value="1" checked>
                                Mister
                            </label>
                            <label>
                                <input type="radio" name="gender" value="2">
                                Missus
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="firstname">First name:</label>
                            <input type="text" name="firstname" id="firstname" class="form-control empty">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="lastname">Last name:</label>
                            <input type="text" name="lastname" id="lastname" class="form-control empty">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-9">
                            <label for="streetname">Streetname:</label>
                            <input type="text" name="streetname" id="streetname" class="form-control empty">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="housenumber">House number:</label>
                            <input type="text" name="housenumber" id="housenumber" class="form-control empty">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="zipcode">Zipcode:</label>
                            <input type="text" name="zipcode" id="zipcode" class="form-control empty">
                        </div>
                        <div class="form-group col-md-9">
                            <label for="city">City:</label>
                            <input type="text" name="city" class="form-control empty">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="country">Country:</label>
                            <input type="text" name="country" id="residence" class="form-control empty">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="state-or-province">State or Province:</label>
                            <input type="text" name="stateOrProvince" class="form-control empty">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="telephonenumber">Telephonenumber:</label>
                            <input type="text" name="phonenumber" id="telephonenumber" class="form-control empty">
                        </div>
                    </div>
                    <div class="row">
                        <div class="checkbox col-md-12">
                            <label>
                                <input type="checkbox" name="billing-address" id="extraDeliverAdress">
                                My deliver adress is an other adress than the one above.
                            </label>
                        </div>
                    </div>
                    <div class="extraAdress">

                        <div class="row">
                            <div class="form-group col-md-9">
                                <label for="streetname">Streetname:</label>
                                <input type="text" name="billing-streetname" id="streetname" class="form-control empty">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="housenumber">House number:</label>
                                <input type="text" name="billing-housenumber" id="housenumber" class="form-control empty">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="zipcode">Zipcode:</label>
                                <input type="text" name="billing-zipcode" id="zipcode" class="form-control empty">
                            </div>
                            <div class="form-group col-md-9">
                                <label for="city">City:</label>
                                <input type="text" name="billing-city" class="form-control empty">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="country">Country:</label>
                                <input type="text" name="billing-country" id="residence" class="form-control empty">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="state-or-province">State or Province:</label>
                                <input type="text" name="billing-stateOrProvince" class="form-control empty">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control username">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="emailadress">Email-adress</label>
                            <input type="email" name="email" id="email" class="form-control email" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control password">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="confirm-password">Confirm password</label>
                            <input type="password" name="confirm-password" id="confirm-password" class="form-control confirm-password">
                        </div>
                    </div>
                    <input type="submit" value="Complete order" name="register" class="btn btn-primary">
                    <input type="hidden" name="webshop" value="register">
                </form>
            </div>
        </div>
    </div>
</div>

<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>
