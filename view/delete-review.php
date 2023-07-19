<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Review | PHP Motors</title>
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
        <main>
            <h1><?php echo 'Delete Review for ' . $review['invMake'] . " " . $review['invModel']; ?></h1>
            <p class="notice">Deletes cannot be undone. Are you sure you want to delete this review?</p>
            <p><?php echo 'The review was created on ' . date('l jS \of F Y', strtotime($review['reviewDate'])) ?></p>
            <?php
            if (isset($message)) {
                echo $message;
            } ?>
            <form action='/phpmotors/reviews/index.php' method='POST'>
                <fieldset>
                    <label for="review">Review Text</label><br>
                    <textarea id="review" rows="3" readonly>
                        <?php echo $review['reviewText'] ?>
                    </textarea><br>
                    <div class='add-review-btn'>
                        <input type='submit' name='submit' value='Delete'>
                        <input type='hidden' name='action' value='deleteReview'>
                        <input type='hidden' name='reviewId' value="<?php echo $review['reviewId'] ?>">
                    </div>
                </fieldset>
            </form>
        </main>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
        </footer>
    </div>
</body>

</html>
<?php unset($_SESSION['message']); ?>