<?php require '../partials/head.php' ?>
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

<?php include '../partials/header.php';?>

<?php

$userData = $user->userData;
if($user->loggedIn) { ?>
    <div class="profile-edit">
        <div class="profile-info-edit">
            <div class="container">
                <form enctype="multipart/form-data" action="../../app/controllers/userController.php" method="post" class="col-md-offset-3 col-md-6">
                    <div class="form-group">
                        <label for="user_description">Your bio! write what you want other people to know about you.</label>
                        <textarea class="form-control" name="user_description" rows="10" cols="100" id="user_description"><?= $userData['user_description'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="profile-picture">Change or insert your profile picture</label>
                        <input type="file" id="profile-picture" name="profile-picture">
                    </div>
                    <div class="form-group password-button">
                        <button class="btn btn-info" type="button">Change password</button>
                    </div>

                    <div class="hidden-fields">
                        <div class="form-group">
                            <label for="password">Fill in your new password</label>
                            <input type="password" id="password" class="form-control" name="password">
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Confirm your password</label>
                            <input type="password" id="confirm-password" class="form-control" name="confirm-password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="first-name">First name</label>
                        <input type="text" id="first-name" class="form-control" name="first-name" value="<?= $userData['firstname'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="last-name">Last name</label>
                        <input type="text" id="last-name" class="form-control" name="last-name" value="<?= $userData['lastname'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="birthdate">Date of birth</label>
                        <input type="date" id="birthdate" class="form-control" name="dob" value="<?= $userData['dob'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" id="country" class="form-control" name="country" value="<?= $userData['country'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="<?= $userData['email'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="mobilenumber">Mobile number</label>
                        <input type="text" id="mobilenumber" class="form-control" name="mobilenumber" value="<?= $userData['mobilenumber'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="phonenumber">Phone number</label>
                        <input type="text" id="phonenumber" class="form-control" name="phonenumber" value="<?= $userData['phonenumber'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="streetname">Street name</label>
                        <input type="text" id="streetname" class="form-control" name="streetname" value="<?= $userData['streetname'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="housenumber">House number</label>
                        <input type="text" id="housenumber" class="form-control" name="housenumber" value="<?= $userData['housenumber'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="zipcode">Zipcode</label>
                        <input type="text" id="zipcode" class="form-control" name="zipcode" value="<?= $userData['zipcode'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" class="form-control" name="city" value="<?= $userData['city'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="state-or-province">State or province</label>
                        <input type="text" id="state-or-province" class="form-control" name="state_or_province" value="<?= $userData['state_or_province'] ?>">
                    </div>

                    <input type="hidden" name="user_id" id="user_id" value="<?= $userData['user_id'] ?>">

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" id="edit" name="edit_profile" value="Edit profile">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php } ?>


<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>
