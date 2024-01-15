<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';

$title = ' - Sign In';
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
        }

        body {
            font-family: Arial, sans-serif;
            background: url('../assets/back.png') no-repeat center center fixed;
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
            backdrop-filter: blur(10px); /* Adjust the blur value as needed */
            filter: blur(0);
        }

        section {
            margin-bottom: 20px;
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

        .form-floating {
            position: relative;
            margin-bottom: 2rem;
        }

        .form-floating input {
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

        .form-floating label {
            position: absolute;
            top: 0;
            left: 10px;
            transform: translateY(-50%);
            color: #fff;
            pointer-events: none;
            transition: top 0.2s ease-out, font-size 0.2s ease-out;
        }

        .form-floating input:focus + label,
        .form-floating input:not(:placeholder-shown) + label {
            top: -1.5rem;
            font-size: 12px;
            color: #fff;
        }

        .checkbox {
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

        .btn-success {
            background-color: #ffc107; /* Yellow color */
            color: #fff;
        }

        .btn-info {
            background-color: #6c757d; /* Grey color */
            color: #fff;
        }

        .btn-success,
        .btn-info {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <main>
        
<section>
            <?php
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
        <form action="../../controllers/auth/signin.php" method="post">
  

            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="Email" placeholder="Email" name="email" maxlength="255"
                    value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : null ?>">
                <label for="Email">Email</label>
            </div>

            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="pass" placeholder="Password" name="pass" maxlength="255"
                    value="<?= isset($_REQUEST['pass']) ? $_REQUEST['pass'] : null ?>">
                <label for="pass">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label><input type="checkbox" value="remember-me"> Remember me</label>
            </div>

            <button class="w-100 btn btn-success" type="submit" name="user" value="login">Sign In</button>
        </form>

        <a href="../../"><button class="w-100 btn btn-info">Back</button></a>
    </main>
</body>
</html>
<?php
?>
