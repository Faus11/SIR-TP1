<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
$title = ' - Sign Up';
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
            backdrop-filter: blur(10px);
            filter: blur(0);
        }

        section {
            margin-bottom: 20px;
        }

        .alert {
            margin-bottom: 20px;
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
            background-color: #ffc107;
            color: #fff;
        }

        .btn-info {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-success,
        .btn-info {
            margin-top: 10px;
        }

        .back-button {
        position: absolute;
        top: 10px;
        left: 10px;
        }

        #logo {
            width: 75px;
            position: absolute;
            top: 10px;
            left: 10px;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }

        /* Media query for smaller screens (e.g., mobile devices) */
        @media (max-width: 526px) {
            #logo {
                display: none; /* Hide the logo on smaller screens */
            }
        }
    </style>
</head>
<body>
      <a href="../../">
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

        <form action="../../controllers/auth/signup.php" method="post" enctype="multipart/form-data">

            <div class="form-floating mb-2">
                <input type="text" class="form-control" name="firstname" placeholder="First Name" maxlength="100"
                       value="<?= isset($_REQUEST['firstname']) ? $_REQUEST['firstname'] : null ?>" required>
                <label for="firstname">First Name</label>
            </div>

            <div class="form-floating mb-2">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name" maxlength="100"
                       value="<?= isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : null ?>" required>
                <label for="lastname">Last Name</label>
            </div>

            <div class="form-floating mb-2">
                <input type="text" class="form-control" name="username" placeholder="Username" maxlength="100"
                       value="<?= isset($_REQUEST['username']) ? $_REQUEST['username'] : null ?>" required>
                <label for="username">Username</label>
            </div>

            <div class="form-floating mb-2">
                <input type="tel" class="form-control" name="phoneNumber" placeholder="Phone Number" maxlength="100"
                       value="<?= isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : null ?>" required>
                <label for="phoneNumber">Phone Number</label>
            </div>

            <div class="form-floating mb-2">
                <input type="email" class="form-control" name="email" placeholder="Email"
                       value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : null ?>">
                <label for="email">Email</label>
            </div>

            <div class="form-floating mb-2">
                <input type="date" class="form-control" name="birthdate" placeholder="Birth Date" maxlength="100"
                       value="<?= isset($_REQUEST['birthdate']) ? $_REQUEST['birthdate'] : null ?>" required>
                <label for="birthdate">Birth Date</label>
            </div>

            <div class="form-floating mb-2">
                <input type="password" class="form-control" name="pass" placeholder="Password" required>
                <label for="pass">Password</label>
            </div>

            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                       placeholder="Confirm Password" required>
                <label for="confirm_password">Confirm Password</label>
            </div>

            <button class="w-100 btn btn-success" type="submit" name="user" value="signUp">Sign Up</button>
        </form>
    </main>
</body>
</html>
<?php
?>
