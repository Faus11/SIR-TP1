<?php
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';
require_once __DIR__ . '/../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '/../../templates/header.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visualContent = [
        'id' => $_POST['id'],
        'title' => $_POST['title'],
        'restricted' => $_POST['restricted'],
        
        'seasons' => $_POST['seasons'],
        'release_date' => $_POST['release_date'],
        'end_date' => $_POST['end_date'],
        'description' => $_POST['description'],
        'cast' => $_POST['cast'],
        'trailer' => $_POST['trailer'],
        'category_id' => $_POST['category_id'],
        'format_id' => $_POST['format_id'],
        'user_id' => $_POST['user_id']
    ];
    unset($visualContent['image']);
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
    <style>
        <?php include "https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"; ?>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            color: white;
        }

        body {
            font-family: Arial, sans-serif;
            background: url('/SIR-TP1/pages/assets/back.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        main {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.12);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        section {
            margin-bottom: 20px;
        }

        .btn-secondary,
        .btn-warning,
        .btn-success,
        .btn-danger {
            margin-bottom: 10px;
        }

        form {
            padding: 20px;
            max-width: 300px; /* Ajuste a largura máxima conforme necessário */
            width: 100%;
            margin: 0 auto; /* Centraliza o formulário */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(30px);
            background: transparent;
        }

        input,
        select {
            margin-bottom: 10px;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
        }

        .btn {
            cursor: pointer;
            width: 100%;
            height: 40px;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            font-size: 16px;
            font-weight: 600;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-success {
            background-color: #e3c624;
            color: #fff;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .form-outline {
            margin-bottom: 20px;
        }

        .form-check {
            margin-bottom: 20px;
        }

        .d-grid {
            margin-top: 20px;
        }

        #logo {
            width: 75px;
            position: absolute;
            top: 10px;
            left: 10px;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }
    </style>
    <!-- Add your CSS styles here or link to an external stylesheet -->
</head>

<body>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $visualContent['id'] ?>">
        <label>Title: <input type="text" name="title" value="<?= $visualContent['title'] ?>"></label><br>
        <label>Restricted: <input type="text" name="restricted" value="<?= $visualContent['restricted'] ?>"></label><br>
        <label>Seasons: <input type="text" name="seasons" value="<?= $visualContent['seasons'] ?>"></label><br>
        <label>Release Date: <input type="date" name="release_date" value="<?= $visualContent['release_date'] ?>"></label><br>
        <label>Description: <input type="text" name="description" value="<?= $visualContent['description'] ?>"></label><br>
        <label>Cast: <input type="text" name="cast" value="<?= $visualContent['cast'] ?>"></label><br>
        <label>Attachments: <input type="text" name="trailer" value="<?= $visualContent['trailer'] ?>"></label><br>
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
        <label> <input type="hidden" class="form-control" name="user_id" min="1" value="<?= isset($user_id) ? $user_id : '' ?>" readonly></label><br>
        <input type="submit" class="btn btn-success" value="Update">
    </form>
</body>

</html>