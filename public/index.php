<?php
require 'partials/head.php';
$result = $product->getMerchendises('Shirts', 4);

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
?>
<title>Home</title>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <?php include 'partials/header.php';?>

        <div class="main-content">
            <div class="slider">
                <div class="container no-padding">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
    
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
    
                            <div class="item active">
                                <img src="img/sales_img/slider_shirt.png" width="800" height="345">
                                <div class="carousel-caption">
                                    <h3>SALE</h3>
                                    <p>Vlambeer Shirt is 50% off!!</p>
                                </div>
                            </div>

                            <div class="item">
                                <img src="img/sales_img/slider_super.png" width="800" height="345">
                                <div class="carousel-caption">
                                    <h3>Merch</h3>
                                    <p>Check out our new merch!!</p>
                                </div>
                            </div>
    
                            <div class="item">
                                <img src="img/sales_img/banner_nuclearthrone.png" width="800" height="345">
                                <div class="carousel-caption">
                                    <h3>SALE!</h3>
                                    <p>Nuclear Throne now 50% off !!!</p>
                                </div>
                            </div>
                        </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            </div>

            <div class="featured-items">
                <div class="official-games">
                    <div class="container">
                        <h2 class="header-white">OFFICIAL <span class="red">VLAM</span>BEER <span class="red">GAMES</span></h2>
                        <div class="games flex jc-c">
                            <div class="game-group flex jc-c">
                                <div class="official-game"><a href="games/gungodz.php">
                                    <img src="<?= $gungodzData->{'results'}->{'image'}->{'medium_url'}?>" alt="gun_godz">
                                    <div class="product-description">
                                        <img src="img/icons/line.png" alt="line">
                                        <h3>Gun Godz</h3>
                                        <p><?= $gungodzData->{'results'}->{'deck'}; ?></p>
                                    </div>
                                    </a>
                                </div>
                                <div class="official-game"><a href="games/luftrausers.php">
                                    <img src="<?= $luftrausersData->{'results'}->{'image'}->{'medium_url'}?>" alt="luftrausers">
                                    <div class="product-description">
                                        <img src="img/icons/line.png" alt="line">
                                        <h3>Luftrausers</h3>
                                        <p><?= $luftrausersData->{'results'}->{'deck'}; ?></p>
                                    </div>
                                    </a>
                                </div>
                                <div class="official-game"><a href="games/nucthrone.php">
                                    <img src="<?= $nucthroneData->{'results'}->{'image'}->{'medium_url'}?>" alt="nuclear throne">
                                    <div class="product-description">
                                        <img src="img/icons/line.png" alt="line">
                                        <h3>Nuclear Throne</h3>
                                        <p><?= $nucthroneData->{'results'}->{'deck'}; ?></p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="game-group flex jc-c">
                                <div class="official-game"><a href="games/ridiculousFishing.php">
                                    <img src="<?= $ridiculousfishingdata->{'results'}->{'image'}->{'medium_url'}?>" alt="ridiculous fishing">
                                    <div class="product-description">
                                        <img src="img/icons/line.png" alt="line">
                                        <h3>Ridiculous Fishing</h3>
                                        <p><?= $ridiculousfishingdata->{'results'}->{'deck'}; ?></p>
                                    </div>
                                    </a>
                                </div>
                                <div class="official-game"><a href="games/serioussam.php">
                                    <img src="<?= $serioussamData->{'results'}->{'image'}->{'medium_url'}?>" alt="serious sam">
                                    <div class="product-description">
                                        <img src="img/icons/line.png" alt="line">
                                        <h3>Serious Sam</h3>
                                        <p><?= $serioussamData->{'results'}->{'deck'}; ?></p>
                                    </div>
                                    </a>
                                </div>
                                <div class="official-game"><a href="games/superCrateBox.php">
                                    <img src="<?= $crateData->{'results'}->{'image'}->{'medium_url'}?>" alt="super crate box">
                                    <div class="product-description">
                                        <img src="img/icons/line.png" alt="line">
                                        <h3>Super Crate Box</h3>
                                        <p><?= $crateData->{'results'}->{'deck'}; ?></p>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="official-merchandise">

                    <div class="container">
                        <h2 class="header-white"><span class="red">VLAM</span>BEER <span class="red">MERCHANDISE</span></h2>
                        <div class="merchandise flex jc-sb">
                            <div class="merchandise-group flex jc-c">
                                
                                <?php foreach($result as $shirt): ?>
                                    <div class="merchandise-item"><a href="shop/product.php?product_id=<?=$shirt['product_id']?>">
                                            <img src="<?= $shirt['product_image_path'] ?>" alt="shirt">
                                            <div class="product-description">
                                                <img src="img/icons/line.png" alt="line">
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
            </div>
            <div class="information">
                <div class="container flex jc-sb fd-r">
                    <div class="twitter">
                        <ul>
                            <?php include 'twitter.php'; ?>
                        </ul>
                    </div>
                    <div class="about">
                        <h2 class="header-white">ABOUT <span class="red">VLAM</span>BEER</h2>
                        <p>Vlambeer is a dutch independent game studio
                            made up of Rami Ismail and Jan Willem Nijman,
                            bringing back arcade games since <span class="red" id="slogan-script2"></span></p>
                    </div>
                </div>
            </div>
        </div>
    <?php require 'partials/footer.php'?>
    <?php require 'partials/foot.php'?>


















        
