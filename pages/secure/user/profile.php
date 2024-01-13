<?php
require_once __DIR__ . '../../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '/../../../helpers/session.php';

$title = ' - Profile';
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
            flex-direction: row; /* Change to row to place buttons side by side */
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
            border-radius: 20px; /* Adjust the border-radius for rounded corners */
            transition: all 0.3s ease; /* Add a smooth transition effect */
        }

        .top-right-buttons .btn:hover {
            color: #000;
            background-color: #f8f9fa; /* Change to your desired hover background color */
            border-color: #fff; /* Set the border color to white */
            backdrop-filter: blur(10px); /* Add blur effect on hover */
        }

        .btn-outline-light.btn-lg {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            background-color: transparent;
            border: 2px solid #fff; /* Set the border color to white */
            border-radius: 20px; /* Adjust the border-radius for rounded corners */
            transition: all 0.3s ease; /* Add a smooth transition effect */
        }

        .btn-outline-light.btn-lg:hover {
            color: #000;
            background-color: #f8f9fa; /* Change to your desired hover background color */
            border-color: #fff; /* Set the border color to white */
            backdrop-filter: blur(10px); /* Add blur effect on hover */
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
<a href="/SIR-TP1/pages/secure">
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
            <form enctype="multipart/form-data" action="/SIR-TP1/controllers/admin/user.php" method="post" class="form-control py-3">

                <div class="input-group mb-3">
                    <span class="input-group-text">Username</span>
                    <input type="text" class="form-control" name="username" placeholder="Username" maxlength="100" size="100"
                        value="<?= isset($_REQUEST['username']) ? $_REQUEST['username'] : $user['username'] ?>" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">First Name</span>
                    <input type="text" class="form-control" name="firstname" placeholder="First Name" maxlength="100" size="100"
                        value="<?= isset($_REQUEST['firstname']) ? $_REQUEST['firstname'] : $user['firstname'] ?>" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Last Name</span>
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" maxlength="100" size="100"
                        value="<?= isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : $user['lastname'] ?>" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Phone Number</span>
                    <input type="tel" class="form-control" name="phoneNumber" maxlength="9"
                        value="<?= isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : $user['phoneNumber'] ?>" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Email</span>
                    <input type="email" class="form-control" name="email" maxlength="255"
                        value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : $user['email'] ?>" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Birthdate</span>
                    <input type="date" class="form-control" name="birthdate" maxlength="100"
                        value="<?= isset($_REQUEST['birthdate']) ? $_REQUEST['birthdate'] : $user['birthdate'] ?>" required>
                </div>
                
               
                
                <div class="d-grid col-4 mx-auto">
                    <button class="w-100 btn btn-lg btn-success mb-2" type="submit" name="user" value="profile">Change</button>
                </div>

                <form action="/SIR-TP1/controllers/admin/user.php" method="post">
                    <input type="hidden" name="delete_user" value="true">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <button class="w-100 btn btn-lg btn-danger mb-2" type="submit" name="user" value="delete">Delete</button>
                </form>
            </form>
        </section>
        <section class="py-4">
            <div class="top-right-buttons">
                <a href="./password.php"><button class="btn-outline-light btn-lg px-4 mx-2">Change Password</button></a>
                <a href="./avatar.php"><button class="btn-outline-light btn-lg px-4 mx-2">Upload avatar</button></a>
            </div>
        </section>
    </main>
</body>

</html>
<?php
?>
