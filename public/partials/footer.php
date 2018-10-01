
<?php
/**
 * Created by PhpStorm.
 * User: kobus
 * Date: 12/1/2016
 * Time: 8:48 AM
 */
?>

<footer>
    <div class="footer-info flex jc-sa">

        <div class="contact-info" id="contact-info">
            <h2><span class="red">Con</span>tact</h2>
            <ul>
                <li><p><img src='<?= BASE_URL ?>public/img/icons/email.png' alt="email-icon">Info@vlambeer.com</p></li>
                <li><p><img src='<?= BASE_URL ?>public/img/icons/phone.png' alt="phone-icon">+31621206363</p></li>
                <li><p><img src='<?= BASE_URL ?>public/img/icons/home-icon.png' alt="house-icon">JAARBEURSPLEIN 6, 3521AL, UTRECHT,</p>
                    <p class="contact-adress">THE NETHERLANDS</p></p></li>
                <li><p><img src='<?= BASE_URL ?>public/img/icons/coin-icon.png' alt="coin-icon">NL822960837B01</p></li>
            </ul>
        </div>

        <div class="twitter-footer" id="twitter-footer">
            <ul>
                <?php include realpath(__DIR__ . "/../twitter.php");?>
            </ul>
        </div>



        <div class="social-media">
            <h2>Let's <span class="red">Connect</span></h2>
            <div class="social-media-icons">
                <img src="<?= BASE_URL ?>public/img/icons/twitter.png" alt="twitter.png">
                <img src="<?= BASE_URL ?>public/img/icons/facebook.png" alt="facebook.png">
                <img src="<?= BASE_URL ?>public/img/icons/youtube.png" alt="youtube.png">
                <img src="<?= BASE_URL ?>public/img/icons/vimeo.png" alt="vimeo.png">
                <img src="<?= BASE_URL ?>public/img/icons/google+.png" alt="google+.png">
            </div>
        </div>
    </div>


</footer>
