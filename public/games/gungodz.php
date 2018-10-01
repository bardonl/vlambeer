<?php require '../partials/head.php';

//Gun godz giantbomb data
$gameGodz = new Giantbombresource("3030-37491", "game");
$gungodzData = $gameGodz->searchall();
?>
<title>Template</title>
</head>
<body>

<?php include '../partials/header.php';?>

<div class="main-content gungodz-content">
    <div class="container">
        <div class="gun-god-logo">
            <img src="../img/gungods/gungodzlogo.png" alt="gun god logo" id="gun-god-logo">

        </div>

        <div class="gun-god-trailer">

            <iframe width="1080" height="420" src="https://www.youtube.com/embed/Ugi18zeQoYc" frameborder="0" allowfullscreen></iframe>

        </div>

        <div id="gun-god-desc">
            <h2><span class="red">Gun</span> godz</h2>
            <p>
                GUN GODZ is a first person shooter about gun, gangster rap and the rich culture of Venus.
                Players try to escape the jail of a hotel, which is the only building on Venus and is owned by a
                record-label owner who happens to be the God of Guns. Featuring a fully Venusian soundtrack by Jukio
                'KOZILEK' Kallio and a singleEnglish track with rap lyrics by Adam 'Doseone' Kidd.
            </p>
            <p>
                GUN GODZ was created for the Venus Patrol Kickstarter and was only released as part of a
                bundle of games including a new Superbrothers game and Adam Atomic's CAPSULE.
            </p>
            <p class="release">Release date: <?= substr($gungodzData->results->original_release_date, 0, 10); ?></p>

            <h3>Features</h3>
            <ul>
                <li>Fast paced gun- and melee combat in a stylish presentation.</li>
                <li>12 levels, 4 secret levels and tons of speedrunning options.</li>
                <li>Full Venusian soundtrack by Jukio "KOZILEK" Kallio and Adam "Doseone" Kidd.</li>
                <li>Player health doesn't recharge.</li>
                <li>Most emotional ending in a videogame to date.</li>
            </ul>
        </div>

        <div class="gg-bottom">
            <a href="https://vlambeer.itch.io/gun-godz" class="gg-download">Download game</a>
            <div class="gg-platform">
                <img src="../img/Luftrausers/platforms/screen.png" alt="windows">
                <img src="../img/Luftrausers/platforms/apple.png" alt="mac/apple">
            </div>
        </div>
    </div>

<?php require '../partials/footer.php'?>
<script src="../js/gun-god-script.js"></script>
<?php require '../partials/foot.php'?>
