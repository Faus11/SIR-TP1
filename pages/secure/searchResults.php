<?php
// Include necessary files and start sessions if needed
@require_once __DIR__ . '/../../helpers/session.php';

$title = ' - Search-Results';
$searchResultsJson = isset($_REQUEST['searchResults']) ? $_REQUEST['searchResults'] : '';
$searchResultsJsonDecoded = urldecode($searchResultsJson);
$searchResults = json_decode($searchResultsJsonDecoded, true);

require_once __DIR__ . '/../../controllers/content/content.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

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
            height: 45px;
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

        .login-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;
        }

        .login-link p a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link p a:hover {
            text-decoration: underline;
        }

        .back-icon {
            font-size: 24px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .top-right-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            flex-direction: row;
            align-items: flex-end;
        }

        .top-right-buttons a {
            margin-right: 10px;
            text-decoration: none;
        }

        .top-right-buttons .btn {
            width: auto;
            background-color: transparent;
            border: 2px solid transparent;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .top-right-buttons .btn:hover {
            color: #000;
            background-color: #f8f9fa;
            border-color: #fff;
            backdrop-filter: blur(10px);
        }

        .btn-outline-light.btn-lg {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            background-color: transparent;
            border: 2px solid #fff;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .btn-outline-light.btn-lg:hover {
            color: #000;
            background-color: #f8f9fa;
            border-color: #fff;
            backdrop-filter: blur(10px);
        }

        #logo {
            width: 75px;
            position: absolute;
            top: 10px;
            left: 10px;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .search-bar {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-bar-size {
            max-width: 600px;
        }

        .form-control {
            border: none;
            border-radius: 20px;
            padding: 12px;
            font-size: 16px;
            color: #495057;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-default {
            background-color: #007bff;
            border: none;
            border-radius: 20px;
            padding: 12px 20px;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .btn-default:hover {
            background-color: #0056b3;
        }

        .heading {
            text-align: center;
            margin: 20px 0;
        }

        .search-icon {
            font-size: 1.5rem;
        }

        .show-list {
            width: 100%;
            max-width: 800px;
        }

        .list-group {
            margin: 0;
            padding: 0;
        }

        .list-group-item {
            background-color: #343a40;
            border: 1px solid #495057;
            margin-bottom: 10px;
        }

        .list-group-item:first-child {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .list-group-item:last-child {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            margin-bottom: 0;
        }

        .list-group-item:hover {
            background-color: #495057;
        }

        .show-details {
            padding: 10px;
        }
    </style>
</head>

<body>
    <main>
        <a href="/SIR-TP1/pages/secure">
            <img id="logo" src="../../pages/assets/image.png" alt="Logo">
        </a>
        <div class="show-list">
            <div class="list-group">
                <?php foreach ($searchResults as $result): ?>
                    <?php $show = getByIdContent($result['id']) ?>
                    <form action="/SIR-TP1/controllers/admin/user.php" method="post" class="form-control py-3">
                        <!-- Add your form elements here with values from $show -->
                        <div class="input-group mb-3">
                            <span class="input-group-text">Show Title</span>
                            <input type="text" class="form-control" name="show_title" placeholder="Show Title" value="<?= $show['title'] ?>" readonly>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Release Date</span>
                            <input type="text" class="form-control" name="release_date" placeholder="Release Date" value="<?= $show['release_date'] ?>" readonly>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</body>

</html>
