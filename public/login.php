<!-- copy en paste dit wanneer je een nieuwe pagina maakt! -->

<?php require 'partials/head.php'; ?>
<title>Template</title>
</head>
<body>

<?php include 'partials/header.php';?>

<!--<div class="main-content form-content">-->
<!--    <div class="container">-->
<!--        <div class="form-wrap">-->
<!--            <form action="--><?//= BASE_URL ?><!--app/controllers/authControll.php" class="form" method="post">-->
<!--                <input type="hidden" name="login" value="check">-->
<!--                <h2 class="title-form">Login</h2>-->
<!--                <div class="form-group">-->
<!--                    <label for="username" class="col-form-label">Username</label>-->
<!--                    <input type="text" class="text-field-form form-control" autocomplete="off" name="username" id="login-username">-->
<!--                    <p class="alert-danger username-error"></p>-->
<!--                </div>-->
<!---->
<!--                <div class="form-group">-->
<!--                    <label for="password" class="col-form-label">Password</label>-->
<!--                    <input type="password" class="text-field-form form-control" autocomplete="off" name="password" id="login-password">-->
<!--                    <p class="alert-danger password-error"></p>-->
<!--                </div>-->
<!--                <span>-->
<!--                    <input type="submit" name="login" value="Submit" class="btn-form">-->
<!--                </span>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="container_login form-content">
    <div class="wrapper">
        <div class="logo_container">
            <div class="login-title">
                <h2>Login</h2>
            </div>
        </div>
        <div class="arrow"></div>
        <form action="<?=BASE_URL?>/app/controllers/authControl.php" method="post">

            <div class="login-forum flex">
                <label>
                    <input class="login-username" type="text" name="username" autocomplete="off" id="login-username" placeholder="Username" />
                    <p class="alert-danger" id=""></p>
                </label>
            </div>

            <div class="login-forum flex">
                <label>
                    <input class="login-password" type="password" name="password" placeholder="Password" id="login-password">
                    <p class="alert-danger" id=""></p>
                </label>
            </div>

            <div class="reset flex">
                <a href="#">Reset Password</a>
                <span>
                    <input type="submit" name="login" autocomplete="off"  value="Submit" class="btn-form">
                </span>
            </div>
        </form>
    </div>
</div>
<?php require 'partials/footer.php'?>
<script src="js/authValidation.js"></script>
<?php require 'partials/foot.php'?>
