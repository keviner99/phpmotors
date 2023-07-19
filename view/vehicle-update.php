<?php
if (!(isset($_SESSION['loggedin']) && $_SESSION['clientData']['clientLevel'] > 1)) {
    header('Location: http://localhost/phpmotors/index.php');
}
?>
<?php
// Build the car classification option list
$classificationList = '<label class="label">';
$classificationList .= "<select name='classificationId' id='classificationId'>";
$classificationList .= "<option value='none'>Choose Car Classification</option>";
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
        if ($classification['classificationId'] == $classificationId) {
            $classificationList .= 'selected';
        }
    } elseif (isset($invInfo['classificationId'])) {
        if ($classification['classificationId'] == $invInfo['classificationId']) {
            $classificationList .= ' selected ';
        }
    }

    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
$classificationList .= '</label>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Modify $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
                echo "Modify $invMake $invModel";
            } ?> | PHP Motors</title>
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
            <h1><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                    echo "Modify $invInfo[invMake] $invInfo[invModel]";
                } elseif (isset($invMake) && isset($invModel)) {
                    echo "Modify $invMake $invModel";
                } ?></h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <div>
                <form action="/phpmotors/vehicles/index.php" method="post">
                    <div class="label">
                        <p id="requiredFields">*Note all fields are Required</p>
                        <?php
                        echo $classificationList;
                        ?>
                    </div>

                    <div class="label">
                        <label class="required" for="invMake">Make</label><br>
                        <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>
                    </div>

                    <div class="label">
                        <label class="required" for="invModel">Model</label><br>
                        <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>
                    </div>

                    <div class="label">
                        <label class="required" for="invDescription">Description</label><br>
                        <textarea id="invDescription" name="invDescription" rows="10" cols="38" required><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                    </div>

                    <div class="label">
                        <label class="required" for="invImage">Image Path</label><br>
                        <input type="text" id="invImage" name="invImage" required <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>><br>
                    </div>

                    <div class="label">
                        <label class="required" for="invThumbnail">Thumbnail Path</label><br>
                        <input type="text" id="invThumbnail" name="invThumbnail" <?php if(isset($invImage)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?> required>

                    </div>

                    <div class="label">
                        <label class="required" for="invPrice">Price</label><br>
                        <input type="text" id="invPrice" name="invPrice" <?php if (isset($invPrice)) {echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?> required><br>
                    </div>

                    <div class="label">
                        <label class="required" for="invStock"># In Stock</label><br>
                        <input type="number" id="invStock" name="invStock" <?php if (isset($invStock)) {echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?> required><br>
                    </div>

                    <div class="label">
                        <label class="required" for="invColor">Color</label><br>
                        <input type="text" id="invColor" name="invColor" list="colors" <?php if (isset($invColor)) {echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?> required><br>
                        <datalist id="colors">
                            <option value="Orange">
                            <option value="Black">
                            <option value="Blue">
                            <option value="purple">
                            <option value="Rust">
                            <option value="Green">
                            <option value="Red">
                            <option value="White">
                            <option value="Silver">
                            <option value="Yellow">
                            <option value="Brown">
                        </datalist>
                    </div>

                    <div class="add-vehicle-btn">
                        <input type="submit" name="submit" value="Update Vehicle">
                        <input type="hidden" name="action" value="updateVehicle">
                        <input type="hidden" name="invId" value="
                        <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                        elseif(isset($invId)){ echo $invId; } ?>
                        ">
                    </div>

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