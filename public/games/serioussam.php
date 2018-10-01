<!-- copy en paste dit wanneer je een nieuwe pagina maakt! -->

<?php require '../partials/head.php';

//Serious sam giantbomb data
$gameSam = new Giantbombresource("3030-34402", "game");
$serioussamData = $gameSam->searchall();
?>
<title>Serious Sam</title>

</head>
<body class="serious-sam">

<?php include '../partials/header.php';?>

<div class="main-content-serious">
    <div class="container">
        <div class="main-content-serious-bg mx-auto">
            <div class="serious-clouds flex jc-sb">
                <img src="../img/serioussam/clouds_l.png" alt="">
                <img src="../img/serioussam/clouds_r.png" alt="">
            </div>
            <div class="serious-bg">

            </div>
            <script>

                    

            </script>
            <div class="row">
                <div class="main-content-serious-logo mx-auto">
                    <div id="logo">
                        <img class="logo" src="../img/serioussam/logo_serious_sam.png" alt="">
                        <img class="top-shot" src="../img/serioussam/shot.png" alt="">
                        <img class="top-bullet" src="../img/serioussam/bullet.png" alt="">
                        <img class="bottom-shot" src="../img/serioussam/shot.png" alt="">
                        <img class="bottom-bullet" src="../img/serioussam/bullet.png" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="main-content-serious-youtube mx-auto">
                    <iframe width="1060" height="480" src="https://www.youtube.com/embed/UZmLptCae1k" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="row flec jc-c">
                <div class="description-serious flex fd-r jc-sb">
                    <div class="description game flex ai-c fd-c">
                        <h2>SERIOUS SAM</h2>
                        <p>The legendary Serious Sam reloads and rearms in an explosive, turn-based RPG developed by indie developer Vlambeer (Super Crate Box, Ridiculous Fishing).
                            Serious Sam: The Random Encounter follows Sam and his band of oddball mercenaries as they battle across a pixilated world teeming chaotic battles,
                            hordes of bizarre creatures, and mysterious secrets. Choose your weapons and take aim at the most random Serious Sam adventure yet!</>
                    </div>
                    <div class="description series  flex ai-c fd-c">
                        <h2>ABOUT THE SERIOUS SAM SERIES</h2>
                        <p>The Serious Sam Indie Series is an extraordinary program launched by Croteam and Devolver Digital to partner with gaming's most creative independent developers
                        and design radically unique Serious Sam games in a variety of styles and genres.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="features flex fd-r jc-sa">
                    <div class="key-features">
                        <h2>KEY FEATURES</h2>
                        <ul>
                            <li>Turn-Based Awesome: Battle across three worlds of pandemonium with Serious Sam and his band of quirky commandos as they clash with legions of relentless creatures hell-bent on ruining your day. Choose your weapons and prepare for an absolute onslaught of merciless enemies charging from every direction.</li>
                            <br>
                            <li>Extraordinary Visual Design: Behold the pixilated brutality of Serious Sam’s struggle against evil in glorious retro-styled graphics. Visit the exotic locals of Egypt and dangerous caverns overrun by Mental’s twisted horde. Battle by land or take on all-new aquatic variations of classic Serious Sam baddies in underwater skirmishes unlike anything Sam has faced before!</li>
                            <br>
                            <li>Serious Strategy: No magic here, son. Select from a variety of dynamic items to increase your party’s stats, toss out some Headless Kamikaze bait, or bring everything to a devastating halt with the all-powerful Serious Bomb.</li>
                            <br>
                            <li>Challenge Mode: Take on a never-ending wave of Mental’s most fearsome minions and attempt to post the best score to win the admiration of your friends and family.</li>
                        </ul>
                        <br>

                        <p>Serious Sam: The Random Encounter was created by Dutch indie duo Rami Ismail & Jan Willem Nijman and features crisp pixel art by Roy Nathan de Groot & pixel-animator Paul Veer.</p>
                        <p>The game had its chiptune music created by Alex Mauer and the trailers were produced by Canadian video-magician Kert Gartner.</p>
                    </div>
<!--                    <div class="serious-wrapper">-->
<!--                        <div class="wrapper-ss">-->
<!--                            <div class="lr-images-ss">-->
<!--                                <div class="large-img-ss slick-slider">-->
<!--                                    <div><img class="large" src="../img/serioussam/slider/ss1.jpg" alt="large image" width="720" height="480"></div>-->
<!--                                    <div><img class="large" src="../img/serioussam/slider/ss2.png" alt="large image" width="720" height="480"></div>-->
<!--                                    <div><img class="large" src="../img/serioussam/slider/ss3.jpg" alt="large image" width="720" height="480" ></div>-->
<!--                                    <div><img class="large" src="../img/serioussam/slider/ss4.jpg" alt="large image" width="720" height="480"></div>-->
<!--                                </div>-->
<!--                                <div class="small-images-ss flex jc-sb">-->
<!--                                    <img class="small" src="../img/serioussam/slider/ss1.jpg" alt="small image">-->
<!--                                    <img class="small" src="../img/serioussam/slider/ss2.png" alt="small image">-->
<!--                                    <img class="small" src="../img/serioussam/slider/ss3.jpg" alt="small image">-->
<!--                                    <img class="small" src="../img/serioussam/slider/ss4.jpg" alt="small image">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>

            </div>
            <div class="row">
                <div class="buy-ss flex fd-c ai-c">
                    <div class="platforms-ss flex jc-c">
                        <div class="platforms">
                            <img src="../img/Luftrausers/platforms/screen.png" alt="PC/Mac">
                            <img class="inactive" src="../img/Luftrausers/platforms/apple.png" alt="iOS">
                            <img src="../img/Luftrausers/platforms/android.png" alt="Android">
                            <img src="../img/Luftrausers/platforms/playstation.png" alt="Playstation">
                            <img class="inactive" src="../img/Luftrausers/platforms/xbox.png" alt="Xbox">
                        </div>
                    </div>
                    <a class="btn-ss-buy flex fd-c jc-c" href="#">Buy Game</a>
                </div>

            </div>
        </div>
    </div>
</div>
<?php require '../partials/footer.php' ?>
<?php require '../partials/foot.php'?>
<script type="text/javascript" src="http://valmbeer.badge-webdevelopment.nl/public/slick/slick.min.js"></script>
<script src="http://valmbeer.badge-webdevelopment.nl/public/js/serioussam.js"></script>
