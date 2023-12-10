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
