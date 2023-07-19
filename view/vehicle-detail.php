<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($invInfo['invMake'])) {
                echo $invInfo['invMake'] . " ";
            }
            if (isset($invInfo['invModel'])) {
                echo $invInfo['invModel'];
            } ?> | PHP Motors </title>
    <link href="/phpmotors/css/small.css" type="text/css" rel="stylesheet">
    <link href="/phpmotors/css/medium.css" type="text/css" rel="stylesheet">
    <link href="/phpmotors/css/large.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php' ?>
        </header>
        <nav>
            <?php echo $navList; //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php' 
            ?>
        </nav>


        <main class="vehicle-detail-father">
            <h1 class="h1details"><?php echo $invInfo['invMake'] . " " . $invInfo['invModel']; ?></h1>
            <?php if (isset($thumbnailList)) {
                echo $thumbnailList;
            }

            ?>

            <?php if (isset($message)) {
                echo $message;
            }
            ?>

            <?php if (isset($vehicle)) {
                echo $vehicle;
            }
            ?>
            <br>
        </main>
        <hr>
        <div class="review-father">
            <h2>Customer Reviews</h2>
            <?php
            if (!isset($_SESSION['loggedin'])) {
                echo '<p>You must<a href = "/phpmotors/accounts/index.php?action=login">login</a>to write a review.</p>';
            }
            ?>


            <?php if (isset($reviewBox) && isset($_SESSION['loggedin'])) {
                echo $reviewBox;
            }

            ?>
            <br>
            <div>
                <?php 
                if (isset($reviewList)) {
                    echo $reviewList;
                }
                ?>
            </div>
        </div>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
        </footer>
    </div>
</body>

</html>