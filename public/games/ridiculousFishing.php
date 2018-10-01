<?php
/**
 * Created by PhpStorm.
 * User: Duck
 * Date: 08/12/2016
 * Time: 08:59
 */
require '../partials/head.php' ?>
<?php include '../partials/header.php';

//Ridiculous fishing giantbomb data
$gameFishing = new Giantbombresource("3030-39474", "game");
$ridiculousfishingdata = $gameFishing->searchall();
?>

    <iframe width="0" height="0" src="https://www.youtube.com/embed/wGKIjh9skYw?autoplay=1" style="display: none;" frameborder="0"></iframe>
<div class="main-content-fishing">
    <div class="container">
        <div class="main-content-fishing-bg mx-auto">
            <div class="row">
                <div class="main-content-fishing-logo mx-auto">
                    <div id="sign">
                        <img class="sign" src="../img/ridiculousFishing/ridiculous-fishing-logo.png" alt="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="main-content-fishing-youtube mx-auto">
                    <iframe width="854" height="480" src="https://www.youtube.com/embed/vzKcJ8QFbMk" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
    <div id="foam">
    </div>
<div id="fishtank">

    <div class="top"></div>
    <div class="bonefish-container" style="position: absolute;width: 100%; height: 100%;">
        <div id="bonefish1" class="bonefish mirror" style="left: 5%; top:80%"></div>
        <div id="bonefish2" class="bonefish" style="left: 80%;"></div>
        <div id="bonefish3" class="bonefish" style="left: 68%; top: 65%"></div>
        <div id="bonefish4" class="bonefish mirror" style="left: 10%"></div>
    </div>
    <div class="guppy-container" style="position: absolute;width: 100%; height: 100%;">
        <div id="guppy" class="guppy mirror" style="top: 10%; left: 10%"></div>
        <div id="guppy1" class="guppy mirror"></div>
        <div id="guppy2" class="guppy"  style="left: 40%; top: 50%;"></div>
        <div id="guppy3" class="guppy" style="left: 90%; top: 10%"></div>
        <div id="guppy4" class="guppy" style="left: 80%; margin-top: 200px;"></div>
    </div>


    <div class="fishing-description-container flex jc-c  full-width">
        <div class="fishing-description">
            <h2 class="flex jc-c">Ridiculous Fishing</h2>
            <p>A handcrafted game about fishing with guns, chainsaws & toasters.</P>

            <p>Follow Billy as he tries to find redemption from his uncertain past. Chase your destiny on the high seas and embark on a heroic quest for glory and gills.</p>
            <p>
                * Hours of gameplay across the continents including a never-ending Infinite arcade world.
                * Dozens of unlockables, weapons and items including popular fishing gear like the Most Expensive Hairdryer In The World and A Bowling Ball.
                * Fish that become hats.
                * No IAP - buy the game, play the game. No additional costs, no hidden fees. Even the hats are IAP-free.
                * Fish that become hats.
            </p>
            <p>Based on Vlambeers popular 2010 original, Ridiculous Fishing was lovingly handcrafted over the course of two years by Vlambeer (Super Crate Box), Zach Gage (Spelltower, Bit Pilot, Unify) and Greg Wohlwend (Hundreds, Solipskier, Gasketball). </p>
        </div>
    </div>

    <div class="rf-rf-rf flex jc-c jc-sb">
        <div class="rf-description">
            <div class="title-rf">
                <h1>Ridiculous Fishing</h1>
            </div>
            <p>Based on Vlambeers popular 2010 original,
                Ridiculous Fishing was lovingly handcrafted over the course of two years by Vlambeer
                (Super Crate Box), Zach Gage (Spelltower, Bit Pilot, Unify) and Greg Wohlwend (Hundreds, Solipskier, Gasketball).
                Winner of the Apple Design Award 2013; Nominated for the 2011 Independent Games Festival Awards; Declared Most Important
                News Story 2011 by industry magazine Control International; Featured in The New York Times </p>
            <p class="release-rf">Release Date: March 18, 2014</p>
            <div class="platforms-rf flex jc-c">
                <div class="platforms">
                    <img src="../img/Luftrausers/platforms/screen.png" alt="PC/Mac">
                    <img class="inactive" src="../img/Luftrausers/platforms/apple.png" alt="iOS">
                    <img src="../img/Luftrausers/platforms/android.png" alt="Android">
                    <img src="../img/Luftrausers/platforms/playstation.png" alt="Playstation">
                    <img class="inactive" src="../img/Luftrausers/platforms/xbox.png" alt="Xbox">
                </div>
            </div>
            <div class="btn-rf-buy flex jc-c">
                <a href="#">Buy Game</a>
            </div>
        </div>

        <div class="wrapper-rf-rf">
            <div class="wrapper-rf">
                <div class="lr-images-rf">
                    <div class="large-img slick-slider">
                        <div><img class="large" src="../img/superbreadbox/sbb1.png" alt="large image"></div>
                        <div><img class="large" src="../img/superbreadbox/sbb2.png" alt="large image"></div>
                        <div><img class="large" src="../img/superbreadbox/sbb3.png" alt="large image"></div>
                        <div><img class="large" src="../img/superbreadbox/sbb4.png" alt="large image"></div>
                    </div>
                    <div class="small-images flex jc-sb">
                        <img class="small" src="../img/superbreadbox/sbb1.png" alt="small image">
                        <img class="small" src="../img/superbreadbox/sbb2.png" alt="small image">
                        <img class="small" src="../img/superbreadbox/sbb3.png" alt="small image">
                        <img class="small" src="../img/superbreadbox/sbb4.png" alt="small image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
<script type="text/javascript" src="<?= BASE_URL ?>public/slick/slick.min.js"></script>
<script src="<?= BASE_URL ?>public/js/ridfish.js"></script>
