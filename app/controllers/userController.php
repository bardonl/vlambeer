

<?php

require_once realpath(__DIR__ . '/../init.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $password = strval($_POST['password']);
    $confirmPassword = strval($_POST['confirm-password']);
    $email = strval($_POST['email']);

//    Checks if password and confirm password are the same string.
    if(!($password == $confirmPassword)) {
        $user->redirect('profile/edit_profile.php');
    }

//    Checks if required fields are filled in.
//    First unset confirm-password
    unset($_POST['confirm-password']);


    foreach($_POST as $key => $value){
//        Phonenumber and user description are allowed to be empty.
        if($key == 'phonenumber' || $key == 'user_description'){
            continue;
        }

//        Check if password is empty. If it's not -> validate the password.
        if(empty($password)){
            continue;
        }

        if($user->lengthVal($password, 6, 50) == 0) {
            die('password does not meet the requirements..');
        }

//        Checks the rest of the fields
        if(empty($value)){
            die('Field is required!');
        }
    }

    $userData = $user->getUserDataById($user->userData['user_id']);

//    Checks if email is free to use.
    $dbEmail = $userData['email'];

    if($user->emailExists($email) == 1) {
        if($email != $dbEmail){
            die('email already exists');
        }
    }

//    Hash the password
    if(!empty($password)){
        $_POST['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

//    var_dump($_POST);
//    var_dump($_FILES);

    $user->editProfile($_POST, $_FILES['profile-picture']);
    $user->redirect('profile/profile.php');
}