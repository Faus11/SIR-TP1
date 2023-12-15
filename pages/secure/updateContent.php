<?php
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';
require_once __DIR__ . '/../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '/../../templates/header.php'; 





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
         $visualContent = [
            'id' => $_POST['id'],
            'title' => $_POST['title'],
            'restricted' => $_POST['restricted'],
            'image' => $_FILES['image']['name'],
            'seasons' => $_POST['seasons'],
            'release_date' => $_POST['release_date'],
            'end_date' => $_POST['end_date'],
            'description' => $_POST['description'],
            'cast' => $_POST['cast'],
            'category_id' => $_POST['category_id'],
            'format_id' => $_POST['format_id'],
            'user_id' => $_POST['user_id']
        ];
        
        updateContent($visualContent);
        header('Location: ./index.php');
        exit();
    }

    $contentId = $_GET['id'];
    $visualContent = getByIdContent($contentId);
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Update</title>
    <!-- Add your CSS styles here or link to an external stylesheet -->
</head>
        
<body>
    <form method="POST">
    <input type="hidden" name="id" value="<?= $visualContent['id'] ?>">
    <label>Title: <input type="text" name="title" value="<?= $visualContent['title'] ?>"></label><br>
    <label>Restricted: <input type="text" name="restricted" value="<?= $visualContent['restricted'] ?>"></label><br>
    <label>Image: <input type="file" name="image"></label><br>
    <label>Seasons: <input type="text" name="seasons" value="<?= $visualContent['seasons'] ?>"></label><br>
    <label>Release Date: <input type="date" name="release_date" value="<?= $visualContent['release_date'] ?>"></label><br>
    <label>End Date: <input type="date" name="end_date" value="<?= $visualContent['end_date'] ?>"></label><br>
    <label>Description: <input type="text" name="description" value="<?= $visualContent['description'] ?>"></label><br>
    <label>Cast: <input type="text" name="cast" value="<?= $visualContent['cast'] ?>"></label><br>
    <label>Category: 
        <select name="category_id">
            <?php
          $categories = [
            1 => 'Drama',
            2 => 'Romance',
            3 => 'Action',
            4 => 'Comedy',
            5 => 'Adventure',
            6 => 'Terror',
            7 => 'Science Fiction',
            8 => 'Crime',
            9 => 'Animation',
            10 => 'Thriller',
            11 => 'Supernatural',
            12 => 'Sports',
           
        ];
            
            foreach ($categories as $id => $category) {
                $selected = ($visualContent['category_id'] == $id) ? 'selected' : '';
                echo "<option value=\"$id\" $selected>$category</option>";
            }
            ?>
        </select>
    </label><br>
    <label>Format: 
        <select name="format_id">
            <?php
           $formats = [
            1 => 'TV Show',
            2 => 'Movie',
            3 => 'Documentary',
            4 => 'Short Film',
            5 => 'Series',
          
           ];        
            
            foreach ($formats as $id => $format) {
                $selected = ($visualContent['format_id'] == $id) ? 'selected' : '';
                echo "<option value=\"$id\" $selected>$format</option>";
            }
            ?>
        </select>
    </label><br>
    <?php

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}
?>
<label>User ID: <input type="text" class="form-control" name="user_id" min="1" value="<?= isset($user_id) ? $user_id : '' ?>" readonly></label><br>
    <input type="submit" value="Update">
</form>
</body>

</html>