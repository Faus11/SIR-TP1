<?php
require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user(); 
$title = '- Categories';
renderHeader($title);
renderNavbar($user);

$category_id = $_GET['category_id'] ?? null;

echo '<form enctype="multipart/form-data" action="/SIR-TP1/controllers/content/content.php" method="post">';
if (!is_numeric($category_id)) {
  echo 'Invalid category ID.';
} else {
  $contentByCategory = getContentByUserIdAndCategory($user['id']);
 
  echo '<style>';
  echo '@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");';

  echo '
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
      width: 200%; /* Ajuste a largura conforme necessÃ¡rio */
    }

    .card-body {
      flex-grow: 1;
    }

    .btn-warning {
      background-color: #e3c624;
      border-color: #e3c624;
      margin-top: auto;
    }
  ';
  echo '</style>';

  echo '<div class="container d-flex justify-content-center align-items-center vh-100">';
  echo '<div class="row">';
  
  if ($contentByCategory && isset($contentByCategory[$category_id])) {
    foreach ($contentByCategory[$category_id] as $content) {
        $contentId = $content['id'];
        $contentLink = "content.php?id=$contentId";
        echo '<div class="col-md-8 mb-7">'; 
        echo '<div class="card card-transparent">'; // Adicionada uma classe card-transparent
        echo '<img class="card-img-top" src="data:image/webp;base64,' . $content['image'] . '" alt="Card image cap">';
        echo '<div class="card-body text-center">';
        echo '<h5 class="card-title text-dark">
        <b>Title:' . $content['title'] . '</b>
        </h5>';
        echo '<p class="card-text text-white">Release Date:' . $content['release_date'] . '</p>';
        echo '<div class="d-flex justify-content-between mt-3">';
        echo '<a href="contentId.php?id=' . $contentId . '" class="btn btn-warning btn-block">View</a>';
        echo '<form action="/SIR-TP1/controllers/content/content.php" method="post">';
        echo '<input type="hidden" name="id" value="' . $contentId . '">';
        echo '<button type="submit" class="btn btn-danger btn-block" name="content" value="delete">Delete</button>';
        echo '</form>';
        echo '<a href="updateContent.php?id=' . $contentId . '" class="btn btn-info btn-block">Update</a>';
        echo '</div>'; 
        echo '</div>'; 
        echo '</div>'; 
        echo '</div>';
      }
  
      echo '</div>'; // Fecha row
      echo '</div>'; // Fecha container
      echo '</div>'; 
  } else {
      echo "<div class='col-md-12 text-center'>";
      echo "No content available for this category.";
      echo "</div>";
  }
}
?>
