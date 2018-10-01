<?php require_once realpath(__DIR__ . '/../init.php');



var_dump($_POST);

if($_SERVER['REQUEST_METHOD'] == "GET") {
    if($_GET['logout'] == "true") {
        $user->userLogout();
        $user->redirect('index.php');
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST") {

    if(isset($_POST['login'])) {
        $arLogin = [];
        $username = strval($_POST['username']);
        $password = strval($_POST['password']);

        if($user->usernameExists($username) == 0) {
            die('username does not exist');
        }

        foreach ($_POST as $key => $val) {
            if($key == 'login' ) {
                continue;
            }

            if(empty($val)) {
                die('leeg :(');
            }

            $arLogin[$key] = $val;
        }

        $userData = $user->getUserDataByName($username);

        if(!password_verify($password, $userData[0]['password'])) {
           die('k');
        }

        $user->userLogin($userData[0]['user_id']);
        $user->redirect('index.php');

        if(isset($_POST['webshop']) && $_POST['webshop'] == 'login') {
            echo 'test';
            if($user->loggedIn == true) {
                if(
                    empty($user->userData['mobilenumber']) ||
                    empty($user->userData['streetname']) ||
                    empty($user->userData['housenumber']) ||
                    empty($user->userData['zipcode']) ||
                    empty($user->userData['city']) ||
                    empty($user->userData['country']) ||
                    empty($user->userData['state_or_province']))
                {
                    // update user met shopping cart info
                    // check of de velden leeg zijn
                    // vul de lege tabel velden
                    // registreet alle velden
                    // stuur door naar afrekenen
                    
                    $user->redirect('profile/edit_profile.php');
                } else {
                    // ga direct naar afrekenen
                }
            }
        }



    }

    if(isset($_POST['register'])) {

        if(isset($_POST['webshop']) && $_POST['webshop'] == 'register') {

            $arRegister = [];
            $arBilling = [];


            $username = strval($_POST['username']);
            $email = strval($_POST['email']);
            $password = strval($_POST['password']);
            $passwordConfirm = strval($_POST['confirm-password']);

            // check if empty

            foreach ($_POST as $key => $val) {
                
                // ignore billing address when not checked
                
                if(!isset($_POST['billing-address']) && $user->contains($key, 'billing')) {
                    continue;
                }
                
                // ignore submit btn, confirm pass and webshop key
                
                if($key == 'register' || $key == 'webshop' || $key == 'confirm-password'
                ) {
                    continue;
                }

                if(empty($val)) {
                    die('empty');
                }
                // push user info en billing in verschillende arrays
                if(!$user->contains($key, 'billing')) {
                    $arRegister[$key] = $val;
                    $arRegister['joinDate'] = date('y-m-d');
                } else {
                    if($key != 'billing-address') {
                        $key = str_replace('billing-', '', $key);
                        $arBilling[$key] = $val;
                    }
                }
            }

            var_dump($arRegister);
            var_dump($arBilling);

            // check available

            if($user->usernameExists($username) == 1) {
                die('username exists');
            }

            if($user->emailExists($email) == 1) {
                die('email exists');
            }

            // check length is safe

            if($user->lengthVal($username, 2, 25) == 0) {
                die('username te kort of lang');
            }

            if($user->lengthVal($password, 6, 50) == 0) {
                die('pass te kort of lang');
            }

            // check password is same

            if($password != $passwordConfirm) {
                die('pass is niet confirm pass');
            }

            // hash pass

            $arRegister['password'] = password_hash($password, PASSWORD_DEFAULT);

            // set userlevel

            $arRegister['userlvl'] = 1;

            // execute register
             $user->webshopRegister($arRegister);

            // check isset billing
            
            if(isset($_POST['billing-address'])) {

                // execute register billing
                $order->registerBillingAddress($arBilling);
            }
        }

        if(isset($_POST['forum-register'])) {

            $arRegister = [];
            $username = strval($_POST['username']);
            $email = $_POST['email'];
            $dob   = strval($_POST['dob']);
            $user_gender   = strval($_POST['user_gender']);
            $country   = strval($_POST['country']);
            $password = strval($_POST['password']);
            $passwordConfirm = $_POST['confirm-password'];
            
            if($user->usernameExists($username) == 1) {

                die('username bestaat al');
            }

            if($user->emailExists($email) == 1) {
                die('email bestaat al');
            }

            if($user->lengthVal($username, 2, 25) == 0) {
                die('username te kort of lang');
            }

            if($user->lengthVal($password, 6, 50) == 0) {
                die('pass te kort of lang');
            }

            if($password != $passwordConfirm) {
                die('pass is niet confirm pass');
            }

            foreach ($_POST as $key => $val) {

                if($key == 'forum-register' || $key == 'register' || $key == 'confirm-password') {
                    continue;
                }


                if(empty($val)) {
                    //redirect
                    die('leeg :( ');
                }

                $arRegister[$key] = $val;
                $arRegister['joinDate'] = date('y-m-d');
                $arRegister['dob']      = date('y-m-d');


            }
            $arRegister['userlvl'] = 1;
            $arRegister['password'] = password_hash($password, PASSWORD_DEFAULT);
            $user->forumRegister($arRegister);
            var_dump($arRegister);

        }
    }
}





