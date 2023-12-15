<?php

// content.php

require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user(); 
$title = 'Content Details';
renderHeader($title);
renderNavbar($user);

$contentId = $_GET['content_id'] ?? null;

echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">';
echo '<div style="text-align: center;">'; 

if (!is_numeric($contentId)) {
    echo '<h3>Invalid content ID.</h3>';
} else {
    $contentInfo = getInfoByIdContent($contentId);

    echo '<h2>' . $contentInfo['title'] . '</h2>';
    echo '<p>Release Date: ' . $contentInfo['release_date'] . '</p>';
    echo '<p>End Date: ' . $contentInfo['end_date'] . '</p>';
   
}

echo '</div>'; 
echo '</div>'; 
?>



