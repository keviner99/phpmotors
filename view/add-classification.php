<?php
if (!(isset($_SESSION['loggedin']) && $_SESSION['clientData']['clientLevel'] > 1)) {
    header('Location: http://localhost/phpmotors/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Classification | PHP Motors</title>
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
            <h1>Add Car Classification</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="post">
                <div>
                    <span>Classification Name must contain no more than 30 characters</span><br>
                    <div class="label">

                        <label class="required" for="classificationId">Classification Name</label><br>
                        <input type="text" id="classificationId" name="classificationName" required pattern="^[A-Za-z0-9]{0,30}$"><br>
                    </div>
                    <div class="add-class-btn">
                        <input type="submit" value="Add Classification">
                        <input type="hidden" name="action" value="add-classification">
                    </div>
                </div>

            </form>
        </main>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
        </footer>
    </div>
</body>

</html>