<?php

require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user(); 
$title = 'Content Details';
renderHeader($title);
renderNavbar($user);

$contentId = $_GET['id'] ?? null;

echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">';
echo '<div style="text-align: center;">'; 

if (!is_numeric($contentId)) {
    echo '<h3>Invalid content ID.</h3>';
} else {
    $contentInfo = getInfoByIdContent($contentId);

    echo '<h2>' . $contentInfo['title'] . '</h2>';
    echo '<p>Release Date: ' . $contentInfo['release_date'] . '</p>';
    echo '<p>End Date: ' . $contentInfo['end_date'] . '</p>';
   
  
    echo '  <form enctype="multipart/form-data" action="/SIR-TP1/controllers/content/content.php" method="post" ">';
    echo '<label for="end_date">Calendariar Filme:</label>';
    echo '<input type="date" id="end_date" name="end_date">';
    echo '<input type="hidden" name="id" value="' . $contentId . '">';
    echo '<input type="submit" name="content" value="add_date">';
    echo '</form>';
}

echo '</div>'; 
echo '</div>'; 
?>




