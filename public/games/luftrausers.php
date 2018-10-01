<?php
/**
 * Created by PhpStorm.
 * User: Jelle
 * Date: 6-12-2016
 * Time: 09:10
 */
require '../partials/head.php';

//Luftrausers giantbomb data
$gameRausers = new Giantbombresource("3030-39474", "game");
$luftrausersData = $gameRausers->searchall();
?>
    <title>Luftrausers</title>
    </head>
    <body>
<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Add your site or application content here -->
<?php include '../partials/header.php';?>

    <div class="main-content">
        <div class="lr-container">
            <img src="http://valmbeer.badge-webdevelopment.nl/public/img/Luftrausers/airplane.png" alt="airplane" class="airplane">
            <img src="http://valmbeer.badge-webdevelopment.nl/public/img/Luftrausers/airplane.png" alt="airplane" class="airplane" id="airplane2">
            <img src="http://valmbeer.badge-webdevelopment.nl/public/img/Luftrausers/airplane.png" alt="airplane" class="airplane" id="airplane3">
            <div class="top-bg"></div>
            <img class="bg" src="../img/Luftrausers/luftrausers_bg.png" alt="luftrausers background">
            <img class="logo" src="../img/Luftrausers/luftrausers_logo.png" alt="luftrausers logo">
            <div class="lr-content">
<!--                <img class="skull" src="../img/Luftrausers/luftrausers_skull_lol.png" alt="skull">-->
                <iframe data-cbsi-video width="1280" height="720" src="http://www.giantbomb.com/videos/embed/7202/" frameborder="0" allowfullscreen></iframe>
                <div class="lr-info flex jc-sa">
                    <div class="lr-description">
                        <div class="title">
                            <h1>Luftrausers</h1>
                        </div>
                        <p><?= $luftrausersData->results->deck; ?></p>

                        <p>The skies will be set aflame and the seas will overflow with wreckage in Vlambeer’s
                        stylish arcade shooter LUFTRAUSERS! Select from over 125 combinations of weapons,
                        bodies, and propulsion systems and take to the skies to battle enemy fighter planes,
                        battleships, submarines, and rival.</p>

                        <p class="release">Release date:
                            <?php
//                            Sets the release date to d-m-Y
                            $releaseDate = substr($luftrausersData->results->original_release_date, 0, 10);
                            $newReleaseDate = date('d-m-Y', strtotime($releaseDate));
                            echo $newReleaseDate;
                            ?>
                        </p>
                        <div class="platforms">
                            <img src="../img/Luftrausers/platforms/screen.png" alt="PC/Mac">
                            <img class="inactive" src="../img/Luftrausers/platforms/apple.png" alt="iOS">
                            <img class="inactive" src="../img/Luftrausers/platforms/android.png" alt="Android">
                            <img src="../img/Luftrausers/platforms/playstation.png" alt="Playstation">
                            <img class="inactive" src="../img/Luftrausers/platforms/xbox.png" alt="Xbox">
                        </div>
                        <a href="#">Buy Game</a>
                    </div>
                    <div class="lr-images">
                        <div class="large-img slick-slider">
                            <div><img class="large" src="../img/Luftrausers/luftrausers-img1.jpg" alt="large image"></div>
                            <div><img class="large" src="../img/Luftrausers/luftrausers-img2.jpg" alt="large image"></div>
                            <div><img class="large" src="../img/Luftrausers/luftrausers-img3.jpg" alt="large image"></div>
                            <div><img class="large" src="../img/Luftrausers/luftrausers-img4.jpg" alt="large image"></div>
                        </div>
                        <div class="small-images flex jc-sb">
                            <img class="small" src="../img/Luftrausers/luftrausers-img1.jpg" alt="small image">
                            <img class="small" src="../img/Luftrausers/luftrausers-img2.jpg" alt="small image">
                            <img class="small" src="../img/Luftrausers/luftrausers-img3.jpg" alt="small image">
                            <img class="small" src="../img/Luftrausers/luftrausers-img4.jpg" alt="small image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-bg"></div>
        </div>
    </div>
<?php require '../partials/footer.php' ?>

<?php require '../partials/foot.php'?>
<script src="../js/luftrausers-script.js"></script>
<script type="text/javascript" src="<?= BASE_URL ?>public/slick/slick.min.js"></script>