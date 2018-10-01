<!-- copy en paste dit wanneer je een nieuwe pagina maakt! -->

<?php require 'partials/head.php'; ?>
<title>Template</title>
</head>
<body>

<?php include 'partials/header.php';?>

<div class="main-content form-content">
    <div class="container">
        <div class="form-wrap">
            <form action="http://valmbeer.badge-webdevelopment.nl/app/controllers/authControl.php" class="form" method="post">
                <input type="hidden" name="register" value="check">
                <input type="hidden" name="forum-register" value="check">
                <h2 class="title-form">Register</h2>
                <div class="form-group register-forum">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="text-field-form form-control" autocomplete="off" id="register-username">
                    <p class="alert-danger"></p>
                </div>

                <div class="form-group register-forum">
                    <label for="dateOfBirth">Date of birth</label>
                    <input type="date" name="dob" class="text-field-form form-control" autocomplete="off" id="dateOfBirth">
                    <p class="alert-danger"></p>
                </div>

                <div class="form-group register-forum">
                    <label for="country">Country</label>
                    <input type="text" name="country" class="text-field-form form-control" autocomplete="off" id="country">
                    <p class="alert-danger"></p>
                </div>

                <div class="form-group register-forum">
                    <label for="gender">Gender</label>
                    <select name="user_gender" id="gender">
                        <option name="male" value="1">Male</option>
                        <option name="female" value="0">Female</option>
                    </select>
                </div>

                <div class="form-group register-forum">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="text-field-form form-control" autocomplete="off" id="register-email">
                    <p class="alert-danger" id=""></p>
                </div>

                <div class="form-group register-forum">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="text-field-form form-control form-password" autocomplete="off" id="register-password">
                    <p class="alert-danger password-error"></p>
                </div>

                <div class="form-group register-forum">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="confirm-password" class="text-field-form form-control form-confirm-password" autocomplete="off" id="register-confirm-password">
                    <p class="alert-danger password-confirm-error"></p>
                </div>

                <span>
                    <input type="submit" name="register" value="Submit" class="btn-form" id="btn-register">
                </span>

            </form>
        </div>
    </div>
</div>
<?php require 'partials/footer.php'?>
<script src="js/authValidation.js"></script>
<?php require 'partials/foot.php'?>
