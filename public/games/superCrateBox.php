<?php require '../partials/head.php';
//Super crate box giantbomb data
$gameCrate = new Giantbombresource("3030-32945", "game");
$crateData = $gameCrate->searchall();
?>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<?php include '../partials/header.php';?>

    <div class="main-content-crate">
        <div id="site">
            <div id="container">
                <div class="crate-menu-top">
                    <div class="crate-logo">
                        <img src="../img/supercratebox/Super_Crate_Box_Logo.png" width="300" height="150" alt="">
                    </div>
                </div>
                <div class="crate-menu-bot">
                    <div id="crate-video">
                        <iframe align="middle" style="border-bottom-left-radius:15px; border-bottom-right-radius:15px;"
                                src="http://player.vimeo.com/video/28179044?title=0&amp;portrait=0&amp;color=ffff00" width="668" height="400" frameborder="0"></iframe>
                    </div>
                </div>
            </div>



            <div class="crate-description">
                <div class="crate-decriptionbox">
                    <h2><span class="red">Des</span>cription</h2>
                    <p class="crate-description-text">Super <span class="red">Crate</span> Box is a shooter-platformer in which the objective is to collect
                        <span class="red">crates</span> for a high score
                        while fighting off hordes of enemies.
                        With further progression through the game and higher scores the player can unlock new player skins,
                        more modes of play, and more experimental weapons.
                    </p>
                    <p class="release crate-description-text">Release date:<?= substr($crateData->results->original_release_date, 0, 10); ?></p>
                </div>
            </div>

            <div id="crateZone"></div>


            <div class="crate-info">
                <div class="crate-decriptionbox">
                    <div class="crate-box-content flex jc-sb">
                        <div class="crate-general-info">
                            <div class="crate-platforms">
                                <h2> Available plat<span class="red">forms</span></h2>
                                <img src="../img/Luftrausers/platforms/screen.png" alt="PC/Mac">
                                <img src="../img/Luftrausers/platforms/apple.png" alt="iOS">
                                <img src="../img/Luftrausers/platforms/android.png" alt="Android">
                                <img src="../img/Luftrausers/platforms/playstation.png" alt="Playstation">
                                <img class="inactive" src="../img/Luftrausers/platforms/xbox.png" alt="Xbox">
                            </div>
                            <div class="crate-cover">
                                <img src="../img/supercratebox/cover.png" height="200" width="160" alt="">
                            </div>
                        </div>
                        <div class="lr-images">
                            <div class="large-img slick-slider">
                                <div><img class="large" src="../img/supercratebox/slider-image-1.jpg" alt="large image"></div>
                                <div><img class="large" src="../img/supercratebox/slider-image-2.png" alt="large image"></div>
                                <div><img class="large" src="../img/supercratebox/slider-image-3.png" alt="large image"></div>
                                <div><img class="large" src="../img/supercratebox/slider-image-4.jpg" alt="large image"></div>
                            </div>
                            <div class="small-images flex jc-sb">
                                <img class="small" src="../img/supercratebox/slider-image-1.jpg" alt="small image">
                                <img class="small" src="../img/supercratebox/slider-image-2.png" alt="small image">
                                <img class="small" src="../img/supercratebox/slider-image-3.png" alt="small image">
                                <img class="small" src="../img/supercratebox/slider-image-4.jpg" alt="small image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    // Crates Falling
    function fallingCrates() {
        var $crates = $(),
            createCrates = function () {
                var qt = 30;
                for (var i = 0; i < qt; ++i) {
                    var $crate = $('<div class="crate"></div>');
                    $crate.css({
                        'left': (Math.random() * $('#site').width()) + 'px',
                        'top': (- Math.random() * $('#site').height()) + 'px'
                    });
                    // add this snowflake to the set of snowflakes
                    $crates = $crates.add($crate);
                }
                $('#crateZone').prepend($crates);
            },

            runCrates = function() {
                $crates.each(function() {

                    var singleAnimation = function($individualCrate) {
                        $individualCrate.animate({
                            top: "2000px",
                            opacity : "0",
                        }, Math.random()*-2500 + 5000, function(){
                            // this particular crate has finished, restart again
                            $individualCrate.css({
                                'left': (Math.random() * $('#site').width()) + 'px',
                                'top': (- Math.random() * $('#site').height()) + 'px',
                                'opacity': 1
                            });
                            singleAnimation($individualCrate);
                        });
                    };
                    singleAnimation($(this));
                });
            };

        createCrates();
        runCrates();
    }
    fallingCrates();

</script>


<?php include '../partials/footer.php';?>
<?php include '../partials/foot.php';?>

<script type="text/javascript" src="<?= BASE_URL ?>public/slick/slick.min.js"></script>
