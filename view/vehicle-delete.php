<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake'])){ echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
            <h1><?php if(isset($invInfo['invMake'])){ echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <p>Confirm Vehicle Deletion. The delete is permanent.</p>
            <div>
                <form action="/phpmotors/vehicles/index.php" method="post">
                    <fieldset>
                        <div class="label">
                        <label for="invMake">Vehicle Make</label><br>
                        <input type="text" readonly name="invMake" id="invMake" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>
                    </div>

                    <div class="label">
                        <label for="invModel">Vehicle Model</label><br>
                        <input type="text" readonly name="invModel" id="invModel" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>
                    </div>

                    <div class="label">
                        <label for="invDescription">Vehicle Description</label><br>
                        <textarea id="invDescription" readonly name="invDescription" rows="10" cols="38"><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                    </div>


                    <div class="add-vehicle-btn">
                        <input type="submit" name="submit" value="Delete Vehicle">
                        <input type="hidden" name="action" value="deleteVehicle">
                        <input type="hidden" name="invId" value="
                        <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">
                    </div>

                    </fieldset>
                </form>
            </div>
        </main>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
        </footer>
    </div>
</body>

</html>