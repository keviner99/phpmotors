<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Registration | PHP Motors</title>
    <link href="/phpmotors/css/small.css" type="text/css" rel="stylesheet">
    <link href="/phpmotors/css/medium.css" type="text/css" rel="stylesheet">
    <link href="/phpmotors/css/large.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <header>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'
            ?>
        </header>
        <nav>
            <?php echo $navList; //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php' 
            ?>
        </nav>
        <main>
            <h1>Register</h1>
            <div>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form action="/phpmotors/accounts/index.php" method="post">
                    <fieldset>
                        <div class="label">
                            <label class="required" for="clientFirstname">First Name</label><br>
                            <input type="text" id="clientFirstname" name="clientFirstname" size="30" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}?> required><br>
                        </div>

                        <div class="label">
                            <label class="required" for="clientLastname">Last Name</label><br>
                            <input type="text" id="clientLastname" name="clientLastname" size="30" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}?> required><br>
                        </div>

                        <div class="label">
                            <label class="required" for="clientEmail">Email</label><br>
                            <input type="email" id="clientEmail" name="clientEmail" size="30" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}?> required><br>
                        </div>

                        <div class="label">
                            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                            <label class="required" for="clientPassword">Password</label><br>
                            <input type="password" id="clientPassword" name="clientPassword" size="30" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                        </div>

                        <div class="registerBtn">
                            <input type="submit" name="submit" id="regbtn" value="Register">
                            <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="register">
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