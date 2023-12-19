<?php
require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user(); 
$title = '- Categories';

renderHeader($title);
renderNavbar($user);
?>

<main class="container">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
      color: white;
    }

    .card-transparent {
      background-color: rgba(0, 0, 0, 0.12);
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(30px);
      background: transparent;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
    }

    .card-body {
      flex-grow: 1;
    }

    .btn-warning {
      background-color: #e3c624;
      border-color: #e3c624;
      margin-top: auto;
    }
  </style>

  <div class="row">
    <?php
    function getAllCategories() {
      return [
          ['id' => 1, 'name' => 'Drama', 'description' => 'Movies that provoke intense emotions.'],
          ['id' => 2, 'name' => 'Romance', 'description' => 'Love stories and romantic adventures.'],
          ['id' => 3, 'name' => 'Action', 'description' => 'High-energy and thrilling action movies.'],
          ['id' => 4, 'name' => 'Comedy', 'description' => 'Movies that make you laugh out loud.'],
          ['id' => 5, 'name' => 'Adventure', 'description' => 'Exciting journeys and adventures.'],
          ['id' => 6, 'name' => 'Terror', 'description' => 'Horror and suspenseful movies.'],
          ['id' => 7, 'name' => 'Science Fiction', 'description' => 'Futuristic and imaginative stories.'],
          ['id' => 8, 'name' => 'Crime', 'description' => 'Movies centered around criminal activities.'],
          ['id' => 9, 'name' => 'Animation', 'description' => 'Animated films for all ages.'],
          ['id' => 10, 'name' => 'Thriller', 'description' => 'Movies filled with suspense and tension.'],
          ['id' => 11, 'name' => 'Supernatural', 'description' => 'Stories with supernatural elements.'],
          ['id' => 12, 'name' => 'Sports', 'description' => 'Movies featuring sports and athleticism.'],
      ];
    }

    $allCategories = getAllCategories();

    if ($allCategories) {
      foreach ($allCategories as $category) {
        $category_id = $category['id'];
        $categoryName = $category['name'];
        $categoryDescription = $category['description'];
        $categoryLink = "category.php?category_id=$category_id"; 

        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card card-transparent">'; // Adicionada uma classe card-transparent
        echo '<div class="card-body">';
        echo "<h5 class='card-title'>$categoryName</h5>";
        echo "<p class='card-text'>$categoryDescription</p>"; 
        echo '</div>';
        echo "<a href='$categoryLink' class='btn btn-warning'>Explore</a>"; 
        echo '</div>';
        echo '</div>';
      }
      echo '</div>'; 
    } else {
      echo '<p>No categories found.</p>';
    }
    ?>
</main>

<?php

?>