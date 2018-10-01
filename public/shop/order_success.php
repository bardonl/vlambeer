<!-- copy en paste dit wanneer je een nieuwe pagina maakt! -->

<?php require '../partials/head.php'; ?>
<title>Template</title>
</head>
<body>

<?php include '../partials/header.php';?>

<div class="main-content">
    <div class="container">
        <div class="complete-center" style="flex-direction: column">
            <h1>Your order is placed!</h1>
            <div class="flex">
                <input type="checkbox" id="get-news" <?= ($user->getUserDataById($user->userId)['has_newsletter'] == 0 ? 'checked' : '') ?> > <p>Wil je niet de newsletter?</p>
            </div>
        </div>
    </div>
</div>
<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>

<script>
    $('document').ready(function () {
        newsLetter = {
            url: "../../app/controllers/moderateControl.php",
            getNewsletter: function (checked1) {
                return $.ajax({
                    url: newsLetter.url,
                    method: 'POST',
                    data: {
                        moderate: 'checkNewsletter',
                        checked: checked1
                    },
                    success: function (test) {
                        console.log(test);
                    }
                })
            }
        };

        $('#get-news:checkbox').on("change", function () {
            var checker = 0;
            if(this.checked) {
                checker = 0;
            } else {
                checker = 1
            }

            newsLetter.getNewsletter(checker);

        })
    });


</script>
