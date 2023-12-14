<?php
require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user(); 
$title = '- Categories';

renderHeader($title);
renderNavbar($user);
?>

<main class="container">
  <div class="row">

  <?php
  function getAllCategories() {
    return [
        ['id' => 1, 'name' => 'Drama'],
        ['id' => 2, 'name' => 'Romance'],
        ['id' => 3, 'name' => 'Action'],
        ['id' => 4, 'name' => 'Comedy'],
        ['id' => 5, 'name' => 'Adventure'],
        ['id' => 6, 'name' => 'Terror'],
        ['id' => 7, 'name' => 'Science Fiction'],
        ['id' => 8, 'name' => 'Crime'],
        ['id' => 9, 'name' => 'Animation'],
        ['id' => 10, 'name' => 'Thriller'],
        ['id' => 11, 'name' => 'Supernatural'],
        ['id' => 12, 'name' => 'Sports'],
    
    ];
}
$allCategories = getAllCategories();

if ($allCategories) {
    foreach ($allCategories as $category) {
      $category_id = $category['id'];
      $categoryName = $category['name'];

      $contentByCategory = getContentByUserIdAndCategory($user['id']);

      echo '<div class="col-md-4 mb-4">';
      echo '<div class="card" style="width: 18rem;" onclick="toggleContent(' . $category_id . ')">';
      echo '<div class="card-body">';
      echo "<h5 class='card-title'>$categoryName</h5>";
      echo '</div>';
      echo '</div>';

      echo "<div class='content-list mt-3' id='category_$category_id' style='display: none;'>";

      $hasContent = false;
      if ($contentByCategory && isset($contentByCategory[$category_id])) {
        foreach ($contentByCategory[$category_id] as $content) {
          $hasContent = true;
          echo '<div class="card mt-2">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title"><b>' . $content['title'] . '</b></h5>';
          echo '<p class="card-text">' . $content['description'] . '</p>';
          echo '</div>';
          echo '</div>';
        }
      }

      if (!$hasContent) {
        echo "<p class='mt-2'>No content available for this category.</p>";
      }

      echo '</div>';
      echo '</div>';
    }
  } else {
    echo '<p>No categories found.</p>';
  }
  ?>
</div>
</main>

<script src="js/script.js"></script>

<?php

?>
