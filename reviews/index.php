<?php
// This is the review Controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the reviews model
require_once '../model/reviews-model.php';
// Get the functions library
require_once '../library/functions.php';
//Get the vehicles model
require_once '../model/vehicles-model.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = createNav($classifications);

//Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {

    case 'addReview':
        // Get the input
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        $invInfo = getInvItemInfo($invId);
        
        // Check for missing data
        if (empty($reviewText) || empty($invId) || empty($clientId)) {
            $message2 = '<p class="notice">Please provide information for all empty form fields.</p>';
            include '../view/vehicle-detail.php';
            exit;
        }

        // Add the review to the database.
        $AddReview = addReview($reviewText, $invId, $clientId);

        // Check and report the result
        if ($AddReview) {
            $message = "<p class='notify'>Review has been added.</p>";
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;
        } else {
            $message = "<p class='notice'>Sorry, there was an error. Please try again.</p>";
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;
        }
        header('location: ../accounts/');
        break;

    case 'editReview':
        // Get user input.
        $reviewText = trim(filter_input(INPUT_POST, 'editReview', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        // Update the review
        $updateReview = updateReview($reviewText, $reviewId);

        $clientId = $_SESSION['clientData']['clientId'];
        $viewReviews = getClientReviews($clientId);
        $reviewList = reviewList($viewReviews);

        // Generate the correct message.
        if ($updateReview == 1) {
            $message = "<p class='notify'>The review was successfully updated.</p>";
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;
        } else {
            $message = "<p class='notice'>Sorry, there was an error. Please try again.</p>";
            $_SESSION['message'] = $message;
            include '../view/admin.php';  
        }
        header('location: ../accounts/');
        exit;
        break;

    case 'updateReview':
        // Get user input.
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        // Get the review information
        $review = getReview($reviewId);

        // Deliver the view.
        include '../view/update-review.php';
        break;

    case 'confirmDelete':
        // Get user input.
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        // Get the review information
        $review = getReview($reviewId);

        // Deliver the view.
        include '../view/delete-review.php';
        break;

    case 'deleteReview':

        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        $deleteReview = deleteReview($reviewId);

        $clientId = $_SESSION['clientData']['clientId'];
        $viewReviews = getClientReviews($clientId);
        $reviewList = reviewList($viewReviews);

        // Generate the correct message.
        if ($deleteReview) {
            $message = "<p class='notify'>The review was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;
        } else {
            $message = "<p class='notice'>Sorry, there was an error. Please try again.</p>";
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;
        }
        exit;
        break;

    default:
        if ($_SESSION['loggedin']) {
            include '..view/admin.php';
            exit;
        }
        exit;
        break;
}
?>