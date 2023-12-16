<?php

require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';
require_once __DIR__ . '/../../infra/repositories/reviewRepository.php';

$user = user();
$userId = $user['id']; 
$title = 'Content Details';
renderHeader($title);
renderNavbar($user);


    echo '<style>';
    echo '.comment-container {
        position: relative;
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }';

    echo '.comment-buttons {
        position: absolute;
        top: 5px;
        right: 5px;
    }';

    echo '.comment-buttons form {
        display: inline;
        margin-right: 5px;
    }';
    echo '</style>';
  
$contentId = $_GET['id'] ?? null;

echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">';
echo '<div style="text-align: left;">'; 

if (!is_numeric($contentId)) {
    echo '<h3>Invalid content ID.</h3>';
} else {
    $contentInfo = getInfoByIdContent($contentId);

    echo '<h2 style="font-size: 35px;"><strong>' . $contentInfo['title'] . '</strong></h2>';
    echo '<p style="font-size: 25px;"><strong>Release Date:</strong> ' . $contentInfo['release_date'] . '</p>';
    echo '<p style="font-size: 25px;"><strong>Description:</strong> ' . $contentInfo['description'] . '</p>';
    echo '<p style="font-size: 25px;"><strong>Cast:</strong> ' . $contentInfo['cast'] . '</p>';
    echo '<p style="font-size: 25px;"><strong>Attachments:</strong> ' . $contentInfo['trailer'] . '</p>';
    echo '<p style="font-size: 25px;"><strong>Seasons:</strong> ' . $contentInfo['seasons'] . '</p>';
    
    

   
  


    echo '<form enctype="multipart/form-data" action="/SIR-TP1/controllers/content/content.php" method="post" ">';
    echo '<label for="end_date">Calendariar Filme:</label>';
    echo '<input type="date" id="end_date" name="end_date">';
    echo '<input type="hidden" name="id" value="' . $contentId . '">';
    echo '<input type="submit" name="content" value="add_date">';
    echo '</form>';
}

echo '</div>'; 
echo '</div>'; 


echo '<hr>'; 



$reviews = getReviewsByUserAndContent($userId, $contentId);

if (count($reviews) > 0) {
    echo '<h3>Comentários:</h3>';
    foreach ($reviews as $review) {
        echo '<div class="comment-container">';
        echo '<div class="comment-content">';
        echo '<p>Comentário: ' . $review['comment'] . '</p>';
        echo '<p>Rating: ' . $review['rating'] . '</p>';
        echo '</div>';

        echo '<div class="comment-buttons">';
        echo '<form enctype="multipart/form-data" action="/SIR-TP1/controllers/review/review.php" method="post">';
        echo '<input type="hidden" name="id_review" value="' . $review['id_review'] . '">';
        echo '<button type="submit" class="btn btn-info name="review" value="edit">Edit</button>';
        echo '</form>';

        echo '<form enctype="multipart/form-data" action="/SIR-TP1/controllers/review/review.php" method="post">';
        echo '<input type="hidden" name="id_review" value="' . $review['id_review'] . '">';
        echo '<button type="submit" class="btn btn-danger name="review" value="delete">Delete</button>';
        echo '</form>';
        echo '</div>'; 

        echo '</div>'; 
    }
} else {
    echo '<p>Não há comentários para este conteúdo.</p>';
}



echo '<form enctype="multipart/form-data" action="/SIR-TP1/controllers/review/review.php" method="post" class="form-control py-3">';
echo '<h3>Adicionar Comentário:</h3>';


echo '<div class="input-group mb-3">';
echo '<span class="input-group-text">Comentário</span>';
echo '<textarea class="form-control" name="comment" rows="4" placeholder="Escreva seu comentário aqui" required>';
echo isset($_REQUEST['comment']) ? $_REQUEST['comment'] : '';
echo '</textarea>';
echo '</div>';

echo '<div class="input-group mb-3">';
echo '<span class="input-group-text">Rating</span>';
echo '<input type="number" class="form-control" name="rating" min="1" max="5" required value="';
echo isset($_REQUEST['rating']) ? $_REQUEST['rating'] : '';
echo '">';
echo '</div>';

echo '<input type="hidden" name="content_id" value="' . $contentId . '">';
echo '<input type="hidden" name="user_id" value="' . $userId . '">';
echo '<input type="submit" name="review" value="create">';
echo '</form>';

echo '</div>'; 
echo '</div>'; 
?>





