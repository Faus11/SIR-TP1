<?php

require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';
require_once __DIR__ . '/../../infra/repositories/reviewRepository.php';

$user = user();
$userId = $user['id']; 
$title = 'Content Details';
renderHeader($title);
renderNavbar($user);

$contentId = $_GET['id'] ?? null;

echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">';
echo '<div style="text-align: left;">'; 

if (!is_numeric($contentId)) {
    echo '<h3>Invalid content ID.</h3>';
} else {
    $contentInfo = getInfoByIdContent($contentId);

    echo '<h2>' . $contentInfo['title'] . '</h2>';
    echo '<p>Release Date: ' . $contentInfo['release_date'] . '</p>';
    echo '<p>End Date: ' . $contentInfo['end_date'] . '</p>';
  
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
        echo '<p>Comentário: ' . $review['comment'] . '</p>';
        echo '<p>Rating: ' . $review['rating'] . '</p>';
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





