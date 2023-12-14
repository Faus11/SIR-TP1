<?php
require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user(); 
$title = '- Categories';
renderHeader($title);
renderNavbar($user);

// Recebendo o category_id da URL
$category_id = $_GET['category_id'] ?? null;

// Verificando se o category_id é válido (é um número)
if (!is_numeric($category_id)) {
  echo 'Invalid category ID.';
} else {
  // Inicialização da variável $contentByCategory específica para a categoria selecionada
  $contentByCategory = getContentByUserIdAndCategory($user['id']);

  echo '<div class="container d-flex justify-content-center align-items-center vh-100">';
  echo '<div class="row">';

  if ($contentByCategory && isset($contentByCategory[$category_id])) {
    foreach ($contentByCategory[$category_id] as $content) {
      $contentId = $content['id'];
      $contentLink = "content.php?content_id=$contentId";

      echo "<div class='col-md-4'>";
      echo "<a href='$contentLink' class='card-link'>";
      echo '<div class="card mt-2">';
      echo '<div class="card-body">';
      echo '<h5 class="card-title"><b>' . $content['title'] . '</b></h5>';
      echo '<p class="card-text">' . $content['description'] . '</p>';
      echo '</div>';
      echo '</div>';
      echo "</a>";
      echo "</div>";
    }
  } else {
    echo "<div class='col-md-12 text-center'>";
    echo "No content available for this category.";
    echo "</div>";
  }

  echo '</div>';
  echo '</div>';
}
?>
