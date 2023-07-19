<?php
//This is the Accounts Controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';
//Get the review model
require_once '../model/reviews-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = createNav($classifications);
// $navList = '<ul>';
// $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) {
//     $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
// }
// $navList .= '</ul>';

// echo $navList;
// exit;

// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    // Code to deliver the views will be here
    
    case 'register':

        // Filter and store the data


        $clientFirstname = trim(filter_input(INPUT_POST,'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST,'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST,'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST,'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for existing email address in the table
        $existingEmail = checkExistingEmail($clientEmail);

        // Deal with existing email during registration
        if ($existingEmail) {
            $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
        $message = '<p class="message-empty">Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit; 
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);


        // Check and report the result

        // Check and report the result
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');

            //$message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            //include '../view/login.php';
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        }else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;

    case 'new-register':
        include '../view/registration.php';
        break;
        

    case 'login':

        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordCheck = checkPassword($clientPassword);

        // Run basic checks, return if errors
        if (empty($clientEmail) || empty($passwordCheck)) {
            $message = '<p class="notice">Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in;
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        
        //Lines to make the review List work
        $clientId = $_SESSION['clientData']['clientId'];
        $viewReviews = getClientReviews($clientId);
        $reviewList = reviewList($viewReviews);
        
        // Send them to the admin view  
        include '../view/admin.php';
        exit;
        break;

    case 'new-login':
        include '../view/login.php';
        exit;

    case 'logout':
        unset($_SESSION['loggedin']);
        unset($_SESSION['clientData']);
        session_destroy();

        header('Location: /phpmotors/');
        exit;
        break;

    case 'modifyAccount':

        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        //Validation created from the functions file
        $clientEmail = checkEmail($clientEmail);
        //Checking if there is an existing email
        $existingEmail = checkExistingEmail($clientEmail);
        //Check for existing email address in the table 
        if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
            if ($existingEmail) {
                $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
                include '../view/client-update.php';
                exit;
            }
        }

        //Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientId)) {
            $message = '<p class="notice">Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit;
        }

        $updateAccount = modifyAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);
        $clientData = getClientById($clientId);
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        if($updateAccount) {
            $message = "<p class='notify'>Congratulations $clientFirstname , Your information has been updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
        } else {
            $message3 = "<p class='notice'>Sorry $clientFirstname , we could not update your account information. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
        exit;
        

    case 'modifyPassword':
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        //check the password
        $passwordCheck = checkPassword($clientPassword);
        //Run basic checks, return if error
        if(empty($passwordCheck)) {
            $message2 = '<p class="notice">Please Make sure your password matches the desired pattern.</p>';
            include '../view/client-update.php';
            exit;
        }
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        $updatePassword = modifyPassword($hashedPassword, $clientId);
        // A valid user exists, log them in
        $clientData = getClientById($clientId);
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        if($updatePassword) {
            $message = "<p class='notify'>Congratulations, the password was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
        } 
        exit;

    case 'updateAccount':
        include '../view/client-update.php';
        exit;
    
    default:

        $clientId = $_SESSION['clientData']['clientId'];
        $viewReviews = getClientReviews($clientId);
        $reviewList = reviewList($viewReviews);

        include '../view/admin.php';
        break;
}


?>