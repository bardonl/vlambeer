<?php
require 'partials/head.php'?>
    <title>Home</title>
    </head>
    <body>
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Add your site or application content here -->
<?php include 'partials/header.php';?>

    <div class="main-content-contact">
        <div class="container">
            <div class="contact">
                <h2>CONTACT <span class="red">US</span></h2>
                <form class="form-horizontal col-md-8 col-md-offset-4" role="form" method="post"">
                    <div class="form-group">
                        <div class="col-sm-6 contact-group">
                            <label for="firstname" class="col-sm-0 control-label">First name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 contact-group">
                            <label for="lastname" class="col-sm-0 control-label">Last name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 contact-group">
                            <label for="email" class="col-sm-0 control-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 contact-group">
                            <label for="message" class="col-sm-0 control-label">Message</label>
                            <textarea class="form-control" rows="4" name="message"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-5 contact-group">
                            <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php require 'partials/footer.php'?>
<?php require 'partials/foot.php'?>
