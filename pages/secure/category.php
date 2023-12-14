<?php
require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user(); 
$title = '- Categories';
renderHeader($title);
renderNavbar($user);


$category_id = $_GET['category_id'] ?? null;


if (!is_numeric($category_id)) {
  echo 'Invalid category ID.';
} else {

  $contentByCategory = getContentByUserIdAndCategory($user['id']);

  echo '<div class="container d-flex justify-content-center align-items-center vh-100">';
  echo '<div class="row">';
  
  if ($contentByCategory && isset($contentByCategory[$category_id])) {
    foreach ($contentByCategory[$category_id] as $content) {
        $contentId = $content['id'];
        $contentLink = "content.php?content_id=$contentId";
        echo '<div class="col-md-7 mb-5">'; 
        echo '<div class="card" style="width: 18rem;">';
        echo '<img class="card-img-top" src="' . $content['image'] . '" alt="Card image cap">';
        echo '<div class="card-body text-center">';
        echo '<h5 class="card-title text-dark"><b>Title:' . $content['title'] . '</b></h5>';
        echo '<p class="card-text text-dark">Release Date:' . $content['release_date'] . '</p>';
        
        echo '<div class="d-flex justify-content-between mt-3">';
        echo '<a href="contentId.php?content_id=' . $contentId . '" class="btn btn-warning btn-block">View</a>';



  
        echo '<br>';
  
        echo '<button type="submit" class="btn btn-danger btn-block">Delete</button>';
  
        echo '<br>';
  
        echo '<a href="update_content.php?content_id=<?= $contentId ?>" class="btn btn-info btn-block">Update</a>';
        echo '</div>'; // Close d-flex
        echo '</div>'; // Close card-body
        echo '</div>'; // Close card
        echo '</div>'; // Close col-md-7
  
  }
  
  echo '</div>'; // Fecha row
  echo '</div>'; // Fecha container

    echo '</div>'; 
} else {
    echo "<div class='col-md-12 text-center'>";
    echo "No content available for this category.";
    echo "</div>";


echo '</div>';
echo '</div>';
}
}
?>
