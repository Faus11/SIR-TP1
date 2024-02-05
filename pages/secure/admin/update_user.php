<?php
require_once __DIR__ . '/../../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '/../../../helpers/validations/admin/validate-user.php';
require_once __DIR__ . '/../../../templates/header.php'; 

$previousPage = $_SERVER['HTTP_REFERER'];

$user = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validatedData = validatedUser($_POST);

    if (isset($validatedData['invalid'])) {
        $_SESSION['errors'] = $validatedData['invalid'];
        header("Location: $previousPage?error=true");
        exit();
    }
    
    $user = [
        'id' => $_POST['id'],
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'username' => $_POST['username'],
        'phoneNumber' => $_POST['phoneNumber'],
        'email' => $_POST['email'],
        'birthdate' => $_POST['birthdate'],
        'admin' => isset($_POST['admin']) ? '1' : '0',
        'pass' => $_POST['pass']
    ];
    updateUser($user);
    $_SESSION['success'] = 'User updated successfully.';
    header('Location: ./index.php');
    exit();
}

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id === null) {
    // Redirecionar ou mostrar uma mensagem de erro
    // Dependendo do seu fluxo de aplicação
}

if ($id !== null) {
    $user = getById($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Update</title>
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

        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(30px);
            background: transparent;
            border-radius: 8px;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
        }

        checkbox {
            margin-top: 10px;
        }

        input[type="submit"] {
            cursor: pointer;
            width: 100%;
            height: 45px;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            font-size: 16px;
            font-weight: 600;
            background-color: #e3c624;
            color: #fff;
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
    <form method="POST">
        <input type="hidden" name="id" value="<?= isset($user['id']) ? $user['id'] : '' ?>">
        <label>First Name: <input type="text" name="firstname" value="<?= isset($user['firstname']) ? $user['firstname'] : '' ?>"></label><br>
        <label>Last Name: <input type="text" name="lastname" value="<?= isset($user['lastname']) ? $user['lastname'] : '' ?>"></label><br>
        <label>Username: <input type="text" name="username" value="<?= isset($user['username']) ? $user['username'] : '' ?>"></label><br>
        <label>Phone Number: <input type="text" name="phoneNumber" value="<?= isset($user['phoneNumber']) ? $user['phoneNumber'] : '' ?>"></label><br>
        <label>Email: <input type="email" name="email" value="<?= isset($user['email']) ? $user['email'] : '' ?>"></label><br>
        <label>Birthdate: <input type="date" name="birthdate" value="<?= isset($user['birthdate']) ? $user['birthdate'] : '' ?>"></label><br>
        <label>Admin: <input type="checkbox" name="admin" <?= isset($user['admin']) && $user['admin'] == '1' ? 'checked' : '' ?>></label><br>
        <label>Password: <input type="password" name="pass"></label><br>
        <input type="submit" value="Update">
    </form>
</body>

</html>
