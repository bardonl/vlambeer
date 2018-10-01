<div class="header">
    <div class="header-top flex jc-sb">
        <div class="container">
            <div class="brand flex fd-r">
                <div class="logo">
                    <a href="<?= BASE_URL ?>public/index.php"><img src="<?= BASE_URL ?>public/img/vlambeer_logo_red.png" height="90" width="70" alt=""></a>
                </div>
                <div class="slogan">
                    <h2><span class="red">VLAM</span>BEER</h2>
                    <p>Bringing back arcade games since <span class="red" id="slogan-script"></span></p>
                </div>
            </div>
        </div>

        <div class="login-menu flex ai-center">
            <ul class="flex"><?php
                if($user->loggedIn == true) {
                    ?>

                    <div class="logged-in">
                        <p class="btn-user-menu"><?= $user->userData['username'] ?><i class="fa fa-caret-down" aria-hidden="true"></i></p>

                    </div>

                    <?php
                } else { ?>
                <li><a class="menu-login"><a href="<?= BASE_URL ?>public/login.php">login</a></a></li>
                <li>|</li>
                <li><a class="menu-register" href="<?= BASE_URL ?>public/register.php"><span class="red">register</span></a></li>
                <?php } ?>
            </ul>
        </div>

        <div class="shoppingcart flex ai-center">
            <span class="trns cart-icon">
                <img src="<?= BASE_URL ?>public/img/icons/shopping-cart.png" alt="shopping">
                
            </span>
            <div id="shop-cart-preview">
                    <input type="hidden" class="shop-cart-preview-placer">
            </div>

            <ul class="user-menu">
                <li><a href="<?= BASE_URL ?>public/profile/profile.php?username=<?= $user->userData['username'] ?>">profile</a></li>

                <?php if($user->userData['fk_user_lvl_id'] == 2): ?>
                    <li><a href="<?= BASE_URL ?>public/order/view-order.php?userid=">Your orders</a></li>
                    <?php else: ?>
                    <li><a href="<?= BASE_URL ?>public/order/view-order.php?userid=<?= $user->userId ?>">Your orders</a></li>
                <?php endif; ?>

                <?php if($user->userData['fk_user_lvl_id'] == 2): ?>
                    <li><a href="<?= BASE_URL ?>public/cms/product_summary.php">Product summary</a></li>
                    <li><a href="<?= BASE_URL ?>public/cms/add_product.php">Add product</a></li>
                <?php endif; ?>
                <?php if($user->userData['fk_user_lvl_id'] == 2 || $user->userData['fk_user_lvl_id'] == 4): ?>
                    <li><a href="<?= BASE_URL ?>public/cms/userPermissions.php">User permissions</a></li>
                <?php endif; ?>
                <li><a style="color: #ed2532;" href="<?= BASE_URL ?>app/controllers/authControl.php?logout=true">Logout</a></li>
            </ul>

        </div>
    </div>

    <div class="header-bottom">
        <div class="nav">
            <ul class="flex">
                <?php
//                Sets active class on nav items.
                $pages = [];
                $pages['index.php'] = 'Home';
                $pages['games.php'] = 'Games';
                $pages['merchandise.php'] = 'Merchandise';
                $pages['forum-categories.php'] = 'Forum';
                $pages['contact.php'] = 'Contact';

                foreach($pages as $url => $title) :
                    $wholeUrl  = $_SERVER['PHP_SELF'];
                    $activePage = basename($wholeUrl);
                    if($url == 'games.php'){
                        $url = 'shop/' . $url;
                        $activePage = 'shop/' . $activePage;
                    }
                    if($url == 'forum-categories.php'){
                        $url = 'forum/' . $url;
                        $activePage = 'forum/' . $activePage;
                    }
                    if(strpos($wholeUrl, 'product')){
                        $url = 'shop/' . $url;
                        $activePage = 'shop/merchandise.php';
                    }
//                    if(strpos($wholeUrl, 'forum')){
//                        $url = 'forum/' . $url;
//                        $activePage = 'forum/' . $activePage;
//                    }
                ?>
                    <a href="<?= BASE_URL ?>public/<?= $url ?>"
                       class="flex-one trns nav-item <?php if($url == $activePage): ?>active-nav<?php endif; ?>">
                        <li class="trns"><?= $title; ?></li>
                    </a>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
