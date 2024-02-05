<?php
require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';


$title = ' - Content';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- Add your CSS styles here or link to an external stylesheet -->
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
            background: url('../../pages/assets/back.png') no-repeat center center fixed;
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

        .form-floating textarea {
            height: 100px;
        }
        #logo {
            width: 75px;
            position: absolute;
            top: 10px;
            left: 10px;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }

    select[name="category_id"] option,
    select[name="format_id"] option {
      color: black; 
    }
    .alert {
    font-size: 15px; 
    padding: 20px; 
    margin-bottom: 20px;
}

.alert-danger {
    background-color: #dc3545;
    color: #fff;
    border: 1px solid #dc3545;
    border-radius: 8px;
}
.alert-success {
    background-color: #28a745; /* Cor verde */
    color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border: 1px solid #218838; /* Cor de borda para o verde */
    border-radius: 8px;
    font-size: 15px;
}
    </style>
</head>

<body>
    
<a href="../../pages/secure">
        <img id="logo" src="../../pages/assets/image.png" alt="Logo">
            </a>
    <main>
    <section>
            <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success" role="alert">';
                echo $_SESSION['success'] . '<br>';
                echo '</div>';
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['errors'])) {
                echo '<div class="alert alert-danger" role="alert">';
                foreach ($_SESSION['errors'] as $error) {
                    echo $error . '<br>';
                }
                echo '</div>';
                unset($_SESSION['errors']);
            }
            ?>
        </section>
        <section class="pb-4">
            <form enctype="multipart/form-data" action="../../controllers/content/content.php" method="post" class="form-control py-3">
                <div class="input-group mb-3">
                    <span class="input-group-text">Title</span>
                    <input type="text" class="form-control" name="title" maxlength="255" value="<?= isset($_REQUEST['title']) ? $_REQUEST['title'] : '' ?>" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Image</span>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Restricted</span>
                    <input type="text" class="form-control" name="restricted" maxlength="3" required
                        value="<?= isset($_REQUEST['restricted']) ? $_REQUEST['restricted'] : null ?>">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Seasons</span>
                    <input type="number" class="form-control" name="seasons" min="1" value="<?= isset($_REQUEST['seasons']) ? $_REQUEST['seasons'] : '' ?>">
                </div>

                <div class="form-floating mb-2">
                    <label for="input-group-text">Description</label>
                    <input class="form-control" name="description" placeholder="Description" style="height: 100px;"value="<?= isset($_REQUEST['description']) ? $_REQUEST['description'] : '' ?>">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Cast</span>
                    <input type="text" class="form-control" name="cast" value="<?= isset($_REQUEST['cast']) ? $_REQUEST['cast'] : '' ?>">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Attachments</span>
                    <input type="text" class="form-control" name="trailer" value="<?= isset($_REQUEST['trailer']) ? $_REQUEST['trailer'] : '' ?>">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Release Date</span>
                    <input type="date" class="form-control" name="release_date" value="<?= isset($_REQUEST['release_date']) ? $_REQUEST['release_date'] : '' ?>">
                </div>


                <div class="input-group mb-3">
            <label for="category">Category</label>
            <select class="form-select" name="category_id">
                <option value="1">Drama</option>
                <option value="2">Romance</option>
                <option value="3">Action</option>
                <option value="4">Comedy</option>
                <option value="5">Adventure</option>
                <option value="6">Terror</option>
                <option value="7">Science Fiction</option>
                <option value="8">Crime</option>
                <option value="9">Animation</option>
                <option value="10">Thriller</option>
                <option value="11">Supernatural</option>
                <option value="12">Sports</option>
              </select>
              </div>

              <div class="input-group mb-3">
            <label for="category">Format</label>
            <select class="form-select" name="format_id">
                <option value="1">TV Show</option>
                <option value="2">Movie</option>
                <option value="3">Documentary</option>
                <option value="4">Short Film</option>
                <option value="5">Series</option>
              </select>
              </div>

                <?php

            if (isset($_SESSION['id'])) {
                $user_id = $_SESSION['id'];
            }
            ?>
            <input type="hidden" class="form-control" name="user_id" min="1" value="<?= isset($user_id) ? $user_id : '' ?>" readonly>

                            <div class="d-grid col-4 mx-auto">
                    <button type="submit" class="btn btn-success" name="content" value="create">Create Content</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>
<?php
?>
