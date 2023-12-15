<?php
require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user(); 
$title = '- Categories';
renderHeader($title);
renderNavbar($user);


$category_id = $_GET['category_id'] ?? null;

 echo '  <form enctype="multipart/form-data" action="/SIR-TP1/controllers/content/content.php" method="post" ">';
if (!is_numeric($category_id)) {
  echo 'Invalid category ID.';
} else {

  $contentByCategory = getContentByUserIdAndCategory($user['id']);
 
  echo '<form enctype="multipart/form-data" action="/SIR-TP1/controllers/content/content.php" method="post">';
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
  
        echo '<form action="/SIR-TP1/controllers/content/content.php" method="post">';
        echo '<input type="hidden" name="id" value="' . $contentId . '">';
        echo '<button type="submit" class="btn btn-danger btn-block" name="content" value="delete">Delete</button>';
        echo '</form>';
  
        echo '<br>';
  
        echo '<a href="updateContent.php?id=' . $contentId . '" class="btn btn-info btn-block">Update</a>';

        echo '</div>'; 
        echo '</div>'; 
        echo '</div>'; 
        echo '</div>'; 
        echo '</form>';
  
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
