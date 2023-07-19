<?php

/*
 * Reviews Model.
 */

// The function inserts a review.
function addReview($reviewText, $invId, $clientId)
{
    
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// The function gets reviews for a specific inventory item.
function getInventoryReviews($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT reviews.reviewId, reviews.reviewText, reviews.reviewDate, reviews.invId, reviews.clientId, clients.clientFirstname, clients.clientLastname FROM reviews INNER JOIN clients ON clients.clientId = reviews.clientId WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewList;
}

// The function gets reviews written by a specific client.
function getClientReviews($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT reviews.reviewId, reviews.reviewText, reviews.reviewDate, reviews.invId, reviews.clientId, inventory.invMake, inventory.invModel FROM reviews INNER JOIN inventory ON reviews.invId = inventory.invId WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewList;
}

// The function gets a specific review.
function getReview($reviewId){
    $db = phpmotorsConnect();
    $sql = 'SELECT reviews.reviewId, reviews.reviewText, reviews.reviewDate, reviews.invId, reviews.clientId, inventory.invMake, inventory.invModel FROM reviews INNER JOIN inventory ON reviews.invId = inventory.invId WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $review = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $review;
}

// The function updates a specific review.
function updateReview($reviewText, $reviewId){
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// The function deletes a review.
function deleteReview($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

?>