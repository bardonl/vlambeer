<?php require_once "../../app/init.php";


if($_POST['check'] == 'user') {
    
    echo $user->usernameExists($_POST['username']);
    
} else if($_POST['check'] == 'email') {
    
    echo $user->emailExists($_POST['email']);
    
}

