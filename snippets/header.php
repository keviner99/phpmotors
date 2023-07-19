<div class=account>
    <img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo" id="logo">
    <?php
    if (isset($_SESSION['loggedin'])) {
        echo "<a href='/phpmotors/accounts/'>Welcome ". $_SESSION['clientData']['clientFirstname']." </a>";
        echo "<a href='/phpmotors/accounts/index.php?action=logout'>Logout</a>";
    }
    else {
        echo "<a id='acc' title='Login or Register with PHP Motors' href='/phpmotors/accounts/index.php?action=new-login'>My Account</a>"; 
    }
    ?>
</div>

    