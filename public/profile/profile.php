<?php require '../partials/head.php' ?>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<?php
include '../partials/header.php';


if(!isset($_GET['username']) || $user->usernameExists($_GET['username']) == 0):?>

    <div class="container complete-center">
        <h1>User Doesn't exist</h1>
    </div>


<?php else:

$username = $_GET['username'];
$userData = $user->getUserDataByName($username)[0]; ?>
<link rel="stylesheet" href="../css/timkt.css">

<div class="user-profile-main">
    <div class="container">
        <div class="user-profile-main-content mx-auto">

            <?php if($userData['username'] == $user->userData['username']): ?>
            <p><a class="red" href="edit_profile.php">Edit profile</a></p>
            <?php endif; ?>
                <div class="public-user-info">
                    <div class="row">
                        <div class="user-profile-user-img col-md-3">
                            <img src="<?= $userData['profile_picture_path'] ?>">
                        </div>
                        <div class="user-profile-user-info col-md-9">
<!--                            Username-->
                            <h2 class="red"><?= $userData['username'] ?></h2>
<!--                            Age, Sex and Country-->
                            <h3>Gender:
                                <?php if ($userData['user_gender'] == 0) {
                                    echo 'Male';
                                    }
                                    else{
                                        echo 'Female';
                                    }
                                ?>
                                 <br>
                                Date of birth: <?php echo $userData['dob']; ?> , <br>
                                Country: <?php echo $userData['country']; ?> , <br>
                                Email: <?= $userData['email']; ?>

<!--                            Rank-->
                            <h3> Rank: <?= $user->getRoleId($userData['user_id']); ?></h3>
                        </div>
                    </div>

                    <div class="user-profile-buttons">
                        <div class="btn-group">
                            <button class="btn btn-primary btn-lg" data-toggle="collapse" href="#latest-posts">Recent posts</button>
                            <button class="btn btn-primary btn-lg" data-toggle="collapse" href="#user-information">Bio</button>
                            <?php if ($user->loggedIn && $user->userData['username'] == $username) { ?>
                                <button class="btn btn-primary btn-lg" data-toggle="collapse" href="#private-information">Private information</button>
                            <?php } ?>
                        </div>
                        <div class="collapse" id="user-information">
                            <div class="card card-block">
                                <?=  $forum->swearFilter($userData['user_description']) ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php if ($user->loggedIn) : ?>
                <div class="private-user-info">
                    <div class="collapse" id="private-information">
                        <div class="card card-block">
                            <p>Mobile number: <?= $userData['mobilenumber'] ?></p>
                            <p>Phone number: <?= $userData['phonenumber'] ?></p>
                            <p>Street name: <?= $userData['streetname'] ?></p>
                            <p>Housenumber: <?= $userData['housenumber'] ?></p>
                            <p>Zipcode: <?= $userData['zipcode'] ?></p>
                            <p>City: <?= $userData['city'] ?></p>
                            <p>State or province: <?= $userData['state_or_province'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
</div>
<?php endif; ?>
<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>