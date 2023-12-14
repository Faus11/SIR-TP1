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

   
    $categoryLink = "category.php?category_id=$category_id"; 

    echo '<div class="col-md-4 mb-4">';
    echo '<div class="card" style="width: 18rem;height: 12rem;">';
    echo '<img class="card-img-top" src="..." alt="Card image cap">'; // Insira a URL da imagem desejada
    echo '<div class="card-body">';
    echo "<h5 class='card-title text-dark'>$categoryName</h5>"; // Adicionando a classe text-dark para tornar o texto preto
    echo '<p class="card-text text-dark">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>'; // Adicionando a classe text-dark para tornar o texto preto
    echo "<a href='$categoryLink' class='btn btn-primary link-no-underline'>Go somewhere</a>"; // Adicionando uma classe personalizada para os links
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
  echo '</div>'; 
} else {
  echo '<p>No categories found.</p>';
}
?>
</div>
</main>

<?php

?>
