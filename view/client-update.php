<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Title | PHP Motors</title>
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
            <h1>Manage Account</h1>
            <div>
                <form action="/phpmotors/accounts/index.php" method="post">
                    <h3>Update Account</h3>
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>

                    <?php
                    if (isset($message3)) {
                        echo $message3;
                    }
                    ?>
                    <div class="label">
                        <label class="required" for="clientFirstname">First Name</label><br>
                        <input type="text" id="clientFirstname" name="clientFirstname" size="30" required <?php if (isset($clientFirstname)) {
                                                                                                                echo "value='$clientFirstname'";
                                                                                                            } elseif (isset($_SESSION['clientData']['clientFirstname'])) {
                                                                                                                echo "value=" . $_SESSION['clientData']['clientFirstname'];
                                                                                                            } ?>><br>
                    </div>

                    <div class="label">
                        <label class="required" for="clientLastname">Last Name</label><br>
                        <input type="text" id="clientLastname" name="clientLastname" size="30" required <?php if (isset($clientLastname)) {
                                                                                                            echo "value='$clientLastname'";
                                                                                                        } elseif (isset($_SESSION['clientData']['clientLastname'])) {
                                                                                                            echo "value=" . $_SESSION['clientData']['clientLastname'];
                                                                                                        } ?>><br>
                    </div>

                    <div class="label">
                        <label class="required" for="clientEmail">Email</label><br>
                        <input type="email" id="clientEmail" name="clientEmail" size="30" required <?php if (isset($clientEmail)) {
                                                                                                        echo "value='$clientEmail'";
                                                                                                    } elseif (isset($_SESSION['clientData']['clientEmail'])) {
                                                                                                        echo "value=" . $_SESSION['clientData']['clientEmail'];
                                                                                                    } ?>><br>
                    </div>

                    <div class="updateBtn">
                        <input type="submit" name="submit" id="update-info-btn" value="Update info">
                        <input type="hidden" name="action" value="modifyAccount">
                        <input type="hidden" name="clientId" value="
                        <?php if (isset($_SESSION['clientData']['clientId'])) {
                            echo $_SESSION['clientData']['clientId'];
                        } elseif (isset($clientId)) {
                            echo $clientId;
                        } ?>">

                    </div>
                </form>
            </div>

            <div>
                <form action="/phpmotors/accounts/index.php" method="post">
                    <h3>Update Password</h3>
                    <?php
                    if (isset($message2)) {
                        echo $message2;
                    }
                    ?>
                    <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</p><br>
                    <span>*note your original password will be changed.</span>

                    <div class="label">
                        <label class="required" for="clientPassword">Password</label><br>
                        <input type="password" id="clientPassword" name="clientPassword" size="30" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                    </div>

                    <div class="updateBtn">
                        <input type="submit" name="submit" id="update-pass-btn" value="Update Password">
                        <input type="hidden" name="action" value="modifyPassword">
                        <input type="hidden" name="clientId" value="<?php if (isset($_SESSION['clientData']['clientId'])) {
                                                                        echo $_SESSION['clientData']['clientId'];
                                                                    } elseif (isset($clientId)) {
                                                                        echo $clientId;
                                                                    } ?>">
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