<?php
require_once __DIR__ . '/../../../infra/middlewares/middleware-administrator.php';

$title = ' - User';
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
            background: url('../../../pages/assets/back.png') no-repeat center center fixed;
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
            .alert {
        font-size: 15px; 
        padding: 10px; 
        margin-bottom: 55px;
    }

    .alert-danger {
        background-color: #dc3545;
        color: #fff;
        border: 1px solid #dc3545;
        border-radius: 10px;
    }
    </style>
</head>

<body>
    <main>
    <a href="../../../pages/secure/admin">
        <img id="logo" src="../../../pages/assets/image.png" alt="Logo">
            </a>
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
            <form enctype="multipart/form-data" action="../../../controllers/admin/user.php" method="post" class="form-control py-3">
                <div class="input-group mb-3">
                    <span class="input-group-text">FirstName</span>
                    <input type="text" class="form-control" name="firstname" maxlength="100" size="100"
                        value="<?= isset($_REQUEST['firstname']) ? $_REQUEST['firstname'] : null ?>" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Last Name</span>
                    <input type="text" class="form-control" name="lastname" maxlength="100" size="100"
                        value="<?= isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : null ?>" required>
                </div>

                <div class="form-floating mb-2">
                <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="username" maxlength="100" size="100"
                        value="<?= isset($_REQUEST['username']) ? $_REQUEST['username'] : null ?>" required>  
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Phone Number</span>
                    <input type="tel" class="form-control" name="phoneNumber" maxlength="9"
                        value="<?= isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : null ?>" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">E-mail</span>
                    <input type="email" class="form-control" name="email" maxlength="255"
                        value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : null ?>" required>
                </div>

                <div class="form-floating mb-2">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" class="form-control" name="birthdate" placeholder="birthdate" maxlength="100" size="100"
                        value="<?= isset($_REQUEST['birthdate']) ? $_REQUEST['birthdate'] : null ?>" required>
                </div>

                <div class="form-outline mb-3">
                    <label class="mb-2" for="pass">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="pass">
                </div>

                <div class="form-outline mb-3">
                    <label class="mb-2" for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
                </div>

                <div class="input-group mb-3">
                    <div class="form-check form-switch mb-3">
                        <label class="form-check-label" for="flexSwitchCheckChecked">admin</label>
                        <input class="form-check-input" type="checkbox" name="admin" role="switch" id="flexSwitchCheckChecked"
                            <?= isset($_REQUEST['admin']) && $_REQUEST['admin'] == true ? 'checked' : null ?>>
                    </div>
                </div>

                <div class="d-grid col-4 mx-auto">
                    <input type="hidden" name="id" value="<?= isset($_REQUEST['id']) ? $_REQUEST['id'] : null ?>">
                    <button type="submit" class="btn btn-success" name="user" <?= isset($_REQUEST['action']) && $_REQUEST['action'] == 'update' ? 'value="update"' : 'value="create"' ?>>Create</button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>
<?php
?>
