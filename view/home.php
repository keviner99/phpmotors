<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | PHP Motors</title>
    <link href="/phpmotors/css/small.css" type="text/css" rel="stylesheet">
    <link href="/phpmotors/css/medium.css" type="text/css" rel="stylesheet">
    <link href="/phpmotors/css/large.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div id="wrapper" class="content-alignment">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php' ?>
        </header>
        <nav>
            <?php echo $navList;//require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php' ?>
        </nav>
        <main>
            <div id="main-content">
                <h1>Welcome to PHP Motors!</h1>
                <div id="banner">
                    <img id="delorean-img" src="/phpmotors/images/vehicles/delorean.jpg" alt="Delorean">
                    <div class="banner-content">
                        <div class="delorean">
                            <p> DMC Delorean <br>3 Cup Holders <br> Superman doors <br> Fuzzy dice!</p>
                        </div>
                        <div class="today">
                            <img id="today" src="/phpmotors/images/site/own_today.png" alt="own today button">
                        </div>
                    </div>
                </div>
                <div class="upgrades">
                    <div class="content-1">
                        <h2>Delorean Upgrades</h2>

                        <div class="upgrades2">

                            <div class="card-img">
                                <img src="/phpmotors/images/upgrades/flux-cap.png" alt="small flux without background">
                                <div class="upgrade-name"><a href="#">Flux Capacitor</a></div>
                            </div>

                            <div class="card-img">
                                <img src="/phpmotors/images/upgrades/flame.jpg" alt="flame with white background">
                                <div class="upgrade-name"><a href="#">Flame Decals</a></div>
                            </div>
                        </div>
                        <div class="upgrades3">

                            <div class="card-img">
                                <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="sticker with hello world message">
                                <div class="upgrade-name"><a href="#">Bumper Stickers</a></div>
                            </div>

                            <div class="card-img">
                                <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="small grey rim with white background">
                                <div class="upgrade-name"><a href="#">Hub Caps</a></div>
                            </div>

                        </div>

                    </div>
                    <div class="content-2">
                        <h2>DMC Delorean Reviews</h2>
                        <ul id="reviews">
                            <li>
                                &quot;So fast, it's almost like it having in time¡&quot; &#40;4&#47;5&#41;
                            </li>
                            <li>
                                &quot;Coolest ride on the road.&quot; &#40;4&#47;5&#41;
                            </li>
                            <li>
                                &quot;I'm feeling Marty McFly¡&quot; &#40;5&#47;5&#41;
                            </li>
                            <li>
                                &quot;The most futuristic ride of our day.&quot; &#40;4.5&#47;5&#41;
                            </li>
                            <li>
                                &quot;80's living and I love it¡&quot; &#40;5&#47;5&#41;
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
        </footer>
    </div>

</body>

</html>