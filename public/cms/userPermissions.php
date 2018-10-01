<?php require '../partials/head.php';

if(!$user->loggedIn || $user->checkUser()){
    $user->redirect('index.php');
}

$moderator = new Moderator();

?>
<title>Template</title>
</head>
<body>

<?php include '../partials/header.php';?>

    <div class="main-content user-permissions">
        <div class="container">
            <div class="top-functions">
                <div class="right-permission">
                </div>
                <div class="search">
                    <label>search user</label>
                    <input type="search" id="search-user" value="" class="form-control" placeholder="search user">
                </div>
            </div>

            <div class="row-th">
                <ul class="row-item-wrap">
                    <li class="row-item">username</li>
                    <li class="row-item">email</li>
                    <?php if ($user->userData['fk_user_lvl_id'] == 2): ?>
                    <li class="row-item">rank</li>
                    <?php endif; ?>
                    <li class="row-item">operations</li>
                </ul>
            </div>
            
        </div>
    </div>



<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>
<script src="http://valmbeer.badge-webdevelopment.nl/public/js/moderator.js"></script>
