<?php
require_once __DIR__ . '/../../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '/../../../templates/header.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    header('Location: ./index.php');
    exit();
}

$id = $_GET['id'];
$user = getById($id);
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
        <a href="/SIR-TP1/pages/secure/admin">
            <img id="logo" src="../../../pages/assets/image.png" alt="Logo">
        </a>
<body>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <label>First Name: <input type="text" name="firstname" value="<?= $user['firstname'] ?>"></label><br>
        <label>Last Name: <input type="text" name="lastname" value="<?= $user['lastname'] ?>"></label><br>
        <label>Username: <input type="text" name="username" value="<?= $user['username'] ?>"></label><br>
        <label>Phone Number: <input type="text" name="phoneNumber" value="<?= $user['phoneNumber'] ?>"></label><br>
        <label>Email: <input type="email" name="email" value="<?= $user['email'] ?>"></label><br>
        <label>Birthdate: <input type="date" name="birthdate" value="<?= $user['birthdate'] ?>"></label><br>
        <label>Admin: <input type="checkbox" name="admin" <?= $user['admin'] == '1' ? 'checked' : '' ?>></label><br>
        <label>Password: <input type="password" name="pass"></label><br>
        <input type="submit" value="Update">
    </form>
</body>

</html>

