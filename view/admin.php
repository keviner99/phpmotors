<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: http://localhost/phpmotors/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | PHP Motors</title>
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
            <h1>
                <?php echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname']; ?>
            </h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <p>You are logged in:</p>
            <ul>
                <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?>
                </li>
                <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?>
                </li>
                <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?>
                </li>
            </ul>

            <?php
            echo "<h2>Account Management</h2>";
            echo "<p>Use this link to update account information.</p>";
            echo "<p><a href='/phpmotors/accounts/index.php?action=updateAccount'>Update Account Information</a></p>";
            ?>

            <?php
            if ($_SESSION['clientData']['clientLevel'] > 1) {
                echo "<h2>Inventory Management</h2>";
                echo "<p>Use this link to manage the inventory.</p>";
                echo "<p><a href='/phpmotors/vehicles/'>Vehicle Management</a></p>";
            }
            ?>

            <?php
            echo "<h2>Manage Your Product Reviews</h2>";
            if (isset($reviewList)){
                echo $reviewList;
            }
            ?>

        </main>
        <hr>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php' ?>
        </footer>
    </div>
</body>

</html><?php unset($_SESSION['message']); ?>