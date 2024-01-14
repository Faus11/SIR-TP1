<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$title = ' - Change password';
$user = user();
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

        .btn-secondary {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .btn-secondary i {
            margin-right: 5px;
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
            display: flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 8px;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
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
</head>
<body>
<a href="../../../pages/secure/user/profile.php">
        <img id="logo" src="../../../pages/assets/image.png" alt="Logo">
            </a>
    <main>
        <section>
            <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                echo $_SESSION['success'] . '<br>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['errors'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                foreach ($_SESSION['errors'] as $error) {
                    echo $error . '<br>';
                }
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                unset($_SESSION['errors']);
            }
            ?>
        </section>
        <section>
            <form action="../../../controllers/admin/user.php" method="post" class="form-control py-3">
                <div class="input-group mb-3">
                    <span class="input-group-text">Name</span>
                    <input type="text" readonly class="form-control" name="firstname" placeholder="<?= $user['firstname'] ?>"
                        value="<?= $user['firstname'] ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Password</span>
                    <input type="password" class="form-control" name="pass" maxlength="255" size="255" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">Confirm Password</span>
                    <input type="password" class="form-control" name="confirm_password" maxlength="255" required>
                </div>
                <div class="d-grid col-4 mx-auto">
                    <button class="w-100 btn btn-lg btn-success mb-2" type="submit" name="user" value="pass">Change</button>
                </div>
            </form>
        </section>
    </main>
    <script>
        // You can add any scripts here if needed
    </script>
</body>
</html>
<?php
?>
