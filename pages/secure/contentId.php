<?php

// content.php

require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user(); 
$title = 'Content Details';
renderHeader($title);
renderNavbar($user);

$contentId = $_GET['content_id'] ?? null;

echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">'; // Estilos para centralizar na vertical e horizontal
echo '<div style="text-align: center;">'; // Centraliza o conteúdo

if (!is_numeric($contentId)) {
    echo '<h3>Invalid content ID.</h3>';
} else {
    $contentInfo = getInfoByIdContent($contentId);

    // Agora você pode usar $contentInfo para exibir os detalhes desse conteúdo
    // Por exemplo:
    echo '<h2>' . $contentInfo['title'] . '</h2>';
    echo '<p>Release Date: ' . $contentInfo['release_date'] . '</p>';
    echo '<p>End Date: ' . $contentInfo['end_date'] . '</p>';
    // Adicione aqui outras informações do conteúdo que você deseja exibir
}

echo '</div>'; 
echo '</div>'; 
?>



