<?php
/**
 * Created by PhpStorm.
 * User: Jelle
 * Date: 9-12-2016
 * Time: 08:59
 */
require '../partials/head.php';

//Giantbomb data from all games
//Serious sam giantbomb data
$gameSam = new Giantbombresource("3030-34402", "game");
$serioussamData = $gameSam->searchall();

//Super crate box giantbomb data
$gameCrate = new Giantbombresource("3030-32945", "game");
$crateData = $gameCrate->searchall();

//Gun godz giantbomb data
$gameGodz = new Giantbombresource("3030-37491", "game");
$gungodzData = $gameGodz->searchall();

//Luftrausers giantbomb data
$gameRausers = new Giantbombresource("3030-39474", "game");
$luftrausersData = $gameRausers->searchall();

//Nuclear throne giantbomb data
$gameThrone = new Giantbombresource("3030-41999", "game");
$nucthroneData = $gameThrone->searchall();

//Ridiculous fishing giantbomb data
$gameFishing = new Giantbombresource("3030-40158", "game");
$ridiculousfishingdata = $gameFishing->searchall();

//Super bread box data
$gameBread = new Giantbombresource("3030-46090", "game");
$breadData = $gameBread->searchall();

?>

    <title>All our games</title>
    </head>
    <body>

<?php include '../partials/header.php';?>

    <div class="main-content-products flex jc-sa">
        <div class="pl-container flex jc-sb">
            <?php
            include '../aside.php';
            ?>
            <div class="product-overview">
                <h2><span class="red">Vlam</span>beer <span class="red">games</span></h2>
                <div class="games flex jc-sb">
                    <div class="official-game"><a href="../games/gungodz.php">
                        <img src="<?= $gungodzData->results->images[1]->medium_url?>">
                        <div class="product-description">
                            <img src="../img/icons/line.png" alt="line">
                            <h3>Gun Godz</h3>
                            <p><?= $gungodzData->results->deck; ?></p>
                        </div>
                        </a>
                    </div>
                    <div class="official-game"><a href="../games/luftrausers.php">
                        <img src="<?= $luftrausersData->results->images[0]->medium_url?>">
                        <div class="product-description">
                            <img src="../img/icons/line.png" alt="line">
                            <h3>Luftrausers</h3>
                            <p><?= $luftrausersData->results->deck; ?></p>
                        </div>
                        </a>
                    </div>
                    <div class="official-game"><a href="../games/nucthrone.php">
                        <img src="<?= $nucthroneData->results->images[3]->medium_url?>">
                        <div class="product-description">
                            <img src="../img/icons/line.png" alt="line">
                            <h3>Nuclear Throne</h3>
                            <p><?= $nucthroneData->results->deck; ?></p>
                        </div>
                        </a>
                    </div>
                    <div class="official-game"><a href="../games/ridiculousFishing.php">
                        <img src="<?= $ridiculousfishingdata->results->images[10]->medium_url?>">
                        <div class="product-description">
                            <img src="../img/icons/line.png" alt="line">
                            <h3>Ridiculous Fishing</h3>
                            <p><?= $ridiculousfishingdata->results->deck; ?></p>
                        </div>
                        </a>
                    </div>
                    <div class="official-game"><a href="../games/serioussam.php">
                        <img src="<?= $serioussamData->results->images[0]->medium_url?>">
                        <div class="product-description">
                            <img src="../img/icons/line.png" alt="line">
                            <h3>Serious Sam</h3>
                            <p><?= $serioussamData->results->deck; ?></p>
                        </div>
                        </a>
                    </div>
                    <div class="official-game"><a href="../games/superCrateBox.php">
                        <img src="<?= $crateData->results->images[0]->medium_url?>">
                        <div class="product-description">
                            <img src="../img/icons/line.png" alt="line">
                            <h3>Super Crate Box</h3>
                            <p><?= $crateData->results->deck; ?></p>
                        </div>
                    </div>
                    </a>
                    <div class="official-game"><a href="../games/superbreadbox.php">
                            <img src="<?= $breadData->results->images[0]->medium_url?>">
                            <div class="product-description">
                                <img src="../img/icons/line.png" alt="line">
                                <h3>Super Bread Box</h3>
                                <p><?= $breadData->results->deck; ?></p>
                            </div>
                    </div>
                    </a>
                </div>
                <h2><span class="red">Special</span> / <span class="red">Bundles</span></h2>
                <div class="games flex jc-sb">
                    <div class="official-game">
                        <img src="../img/special_bundle.jpg" alt="vlambeer bundle">
                        <div class="product-description">
                            <img src="../img/icons/line.png" alt="line">
                            <h3>Vlambeer's Bundle</h3>
                            <p>A nice little description about this amazing bundle given to you by
                                Vlambeer! This bundle contains who knows what. It might contains a
                                shooter, or an RPG, MMO, racing game, etc...</p>
                        </div>
                    </div>
                    <div class="official-game">
                        <img src="../img/special_bundle.jpg" alt="vlambeer bundle">
                        <div class="product-description">
                            <img src="../img/icons/line.png" alt="line">
                            <h3>Vlambeer's Bundle</h3>
                            <p>A nice little description about this amazing bundle given to you by
                                Vlambeer! This bundle contains who knows what. It might contains a
                                shooter, or an RPG, MMO, racing game, etc...</p>
                        </div>
                    </div>
                </div>
                <h2>Not <span class="red">vlam</span>beer</h2>
                <div class="games flex jc-sb">
                    <div class="official-game">
                        <img src="../img/dinosaur-zoo-keeper.jpg" alt="dinosaur zoo keeper">
                        <div class="product-description">
                            <img src="../img/icons/line.png" alt="line">
                            <h3>Dinosaur zoo keeper</h3>
                            <p>You are the owner of a dangereous Dinosaur Zoo. You have to make sure that the Dino's
                                stay behind their fences and the visitors are save.</p>
                        </div>
                    </div>
                    <div class="official-game">
                        <img src="../img/luftrauser.jpg" alt="luftrauser">
                        <div class="product-description">
                            <img src="../img/icons/line.png" alt="line">
                            <h3>Luftrauser</h3>
                            <p>Luftrauser is a prototype for the full retail game luftrausers, and is free to play online. Created by Rami Ismail and Jan Willem Nijman.
                                Try to survive as long as possible against endless attacks of airplanes and battleships. Enjoy Luftrauser!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require '../partials/footer.php' ?>
    <?php require '../partials/foot.php'?>