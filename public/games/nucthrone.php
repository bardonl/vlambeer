<?php require '../partials/head.php';
//Nuclear throne giantbomb data
$gameThrone = new Giantbombresource("3030-41999", "game");
$nucthroneData = $gameThrone->searchall();
?>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<?php include '../partials/header.php';?>
    <link rel="stylesheet" href="../css/timkt.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>


    <div class="main-content-nucthrone">
        <div class="container">

            <div class="main-content-nucthrone-bg mx-auto">

                <div class="row">

                    <div class="main-content-nucthrone-logo mx-auto">
                        <div class="non-glow"><img src="../img/nucthrone/nucthrone_logo.png"></div>
                        <div class="glow"><img src="../img/nucthrone/nucthrone_logo_glow.png"></div>
                    </div>

                </div>

                <div class="row">

                    <div class="main-content-nucthrone-youtube mx-auto">

                        <iframe width="1060" height="480" src="https://www.youtube.com/embed/7LSs1bj41P4" frameborder="0" allowfullscreen></iframe>
                    </div>

                </div>

                <div class="row">

                    <div class="main-content-nucthrone-info">

                        <div class="col-md-6 text-center">
                            <h1>Nuclear Throne</h1>
                            <p></p>
                            <p><?= $nucthroneData->results->deck ?></p>
                            <p>Nuclear Throne is a post-apocalyptic roguelike-like top-down shooter. Not 'the final hope of humanity' post-apocalyptic, but 'humanity is extinct and mutants and monsters now roam the world' post-apocalyptic. Fight your way through the wastelands with powerful weaponry, collecting radiation to mutate some new limbs and abilities. All these things and more you could do if only you were good at this game. Can you reach the Nuclear Throne?</p>
                            
                        </div>

                        <div class="col-md-6 main-content-nucthrone-images">

                            <div class="slick-big-img slick-slider slider-for">
                                <div><img src="../img/nucthrone/nuc_big_img1.png" alt=""></div>
                                <div><img src="../img/nucthrone/nuc_big_img2.png" alt=""></div>
                                <div><img src="../img/nucthrone/nuc_big_img3.png" alt=""></div>
                                <div><img src="../img/nucthrone/nuc_big_img4.png" alt=""></div>
                            </div>
                            <div class="slick-small-img slick-slider slider-nav">
                                <div><img src="../img/nucthrone/nuc_big_img1.png" alt=""></div>
                                <div><img src="../img/nucthrone/nuc_big_img2.png" alt=""></div>
                                <div><img src="../img/nucthrone/nuc_big_img3.png" alt=""></div>
                                <div><img src="../img/nucthrone/nuc_big_img4.png" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="row">
                <div class="main-content-nucthrone-bg-img mx-auto">
                    <img src="../img/nucthrone/nucthrone_faded_bg.png" alt="">
                </div>


                
            </div>
        </div>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: false,
                autoplay: true,
                asNavFor: '.slider-nav'
            });
            $('.slider-nav').slick({
                slidesToShow: 3, // 3,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: true,
                centerMode: true,
                focusOnSelect: true
            });
        });

        var playing = true;

        function loop(){
            if(playing){
                $('.main-content-nucthrone-logo img:eq(1)').fadeIn(2000, function(){
                    $(this).fadeOut(2000,loop);
                });
            }
        }

        loop();
    </script>



<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>

<script type="text/javascript" src="<?= BASE_URL ?>public/slick/slick.min.js"></script>
