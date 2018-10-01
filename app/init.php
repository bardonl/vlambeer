<?php

require_once dirname(__FILE__) .'/config.php';

session_start();

//Require alle classes

spl_autoload_register( function($class) {

    if ( file_exists(__DIR__ . '/classes/' . $class . '.php') ) {

        require realpath(__DIR__ . '/classes/' . $class . '.php');

    }
});


//deze info zit niet in de login functie maar init zodat de data altijd up to date is

$user = new User();
$order = new Order();
$forum = new Forum();
$product = new Product();
$forumDennis = new ForumDennis();
$shoppingCart = new Shoppingcart();

if(isset($_SESSION['user_id'])) {

    // vult user id in class
    $user->setUserId($_SESSION['user_id']);

    // Zet logged in op true
    $user->setLoggedIn(true);

    // vult user data
    $user->setUserData($user->userId);

    $user->setRole($user->getRoleId($user->userId));

    // check banned
    if($user->userData['is_banned'] == 1) {
        $user->isBanned = 1;
    } else {
        $user->isBanned = 0;
    }

    // check mod
    if($user->role == 'Moderator') {
        $user->isMod = 1;
    } else {
        $user->isMod = 0;
    }
}

?>