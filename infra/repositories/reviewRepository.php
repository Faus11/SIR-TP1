<?php
require_once __DIR__ . '../../db/connection.php';

function createReview($review)
{
    $sqlCreate = "INSERT INTO 
        content_review (
            comment, 
            rating,
            date_hour, 
            created_at,
            content_id,
            user_id) 
        VALUES (
            :comment, 
            :rating,
             NOW(), 
             NOW(), 
            :content_id,
            :user_id
        )";

    // PREPARE QUERY
    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    // EXECUTE
    $success = $PDOStatement->execute([
        ':comment' => $review['comment'],
        ':rating' => $review['rating'],
        ':content_id' => $review['content_id'],
        ':user_id' => $review['user_id']
    ]);

    if ($success) {
        $visualContent['id_review'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}


function getAllReview()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM content_review;');
    $review = [];
    while ($listaDereview = $PDOStatement->fetch()) {
        $review[] = $listaDereview;
    }
    return $review;
}

function updateReview($review)
{
    $params = [
        ':comment' => $review['comment'],
        ':rating' => $review['rating'],
        ':date_hour' => $review['date_hour'],
        ':content_id' => $review['content_id'],
        ':user_id' => $review['user_id'],
        ':id_review' => $review['id_review']
    ];


    $sqlUpdate = "UPDATE content_review SET
    comment = :comment, 
    rating = :rating,
    date_hour = NOW(),
    content_id = :content_id,
    user_id = :user_id,
    updated_at = NOW()
    WHERE id_review = :id_review";


    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);
    return $PDOStatement->execute($params);
}

function deleteReview($reviewId)
{
    $sqlDelete = "DELETE FROM content_review WHERE id_review = :id_review";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlDelete);

    return $PDOStatement->execute([
        ':id_review' => $reviewId, 
    ]);
}


function createNewReview($review)
{
    $review['created_at'] = date('Y-m-d H:i:s'); 

    $sqlCreate = "INSERT INTO 
    content_review (
        comment, 
        rating,
        date_hour, 
        created_at,
        content_id,
        user_id) 
    VALUES (
        :comment, 
        :rating,
        NOW(), 
        :created_at,
        :content_id,
        :user_id
    )";

$PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

#EXECUTE
$success = $PDOStatement->execute([
    ':comment' => $review['comment'],
    ':rating' => $review['rating'],
    ':date_hour' => $review['date_hour'],
    ':created_at' => $review['created_at'],
    ':content_id' => $review['content_id'],
    ':user_id' => $review['user_id']
]);

    if ($success) {
        $visualContent['id_review'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}

function getReviewsByUserAndContent($userId, $contentId)
{
    $sql = "SELECT * FROM content_review WHERE user_id = :user_id AND content_id = :content_id";

    $PDOStatement = $GLOBALS['pdo']->prepare($sql);
    $PDOStatement->execute([
        ':user_id' => $userId,
        ':content_id' => $contentId
    ]);

    $reviews = [];
    while ($review = $PDOStatement->fetch()) {
        $reviews[] = $review;
    }

    return $reviews;
}
