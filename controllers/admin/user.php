<?php

require_once __DIR__ . '/../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../helpers/validations/admin/validate-user.php';
require_once __DIR__ . '/../../helpers/validations/admin/validate-password.php';
require_once __DIR__ . '/../../helpers/session.php';
require_once __DIR__ . '/../../controllers/auth/signin.php';


if (isset($_POST['user'])) {
    if ($_POST['user'] == 'create') {
        create($_POST);
    }

    if ($_POST['user'] == 'update') {
        update($_POST);
    }

    if ($_POST['user'] == 'profile') {
        updateProfile($_POST);
    }

    if ($_POST['user'] == 'update_user') {
        updateUserbyADM($_POST);
    }

    if ($_POST['user'] == 'pass') {
        changePassword($_POST);
    }
    if ($_POST['user'] == 'delete') {
        delete_user($_POST);
        if (isset($_POST['delete_user']) && $_POST['delete_user'] === 'true' && isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        delete_user(['id' => $user_id]);
        header('Location: ../../');
    exit(); 
    }
    
}}

if (isset($_GET['user'])) {
    if ($_GET['user'] == 'update') {
        $user = getById($_GET['id']);
        $user['action'] = 'update';
        $params = '?' . http_build_query($user);
        header('location: ../../pages/secure/admin/user.php' . $params);
    }

    if ($_GET['user'] == 'delete') {
        $user = getById($_GET['id']);
        if ($user['admin']) {
            $_SESSION['errors'] = ['This user cannot be deleted!'];
            header('location: ../../pages/secure/admin/');
            return false;
        }

        $success = delete_user($user);

        if ($success) {
            $_SESSION['success'] = 'User deleted successfully!';
            header('location: ../../pages/secure/admin/');
        }
    }
}

function create($req)
{
    $data = validatedUser($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: ../../pages/secure/admin/user.php' . $params);
        return false;
    }

    $success = createUser($data);

    if ($success) {
        $_SESSION['success'] = 'User created successfully!';
        header('location: ../../pages/secure/admin/');
    }
}

function update($req)
{
    $data = validatedUser($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $_SESSION['action'] = 'update';
        $params = '?' . http_build_query($req);
        header('location: ../../pages/secure/admin/user.php' . $params);
        return false;
    }

    $success = updateUser($data);

    if ($success) {
        $_SESSION['success'] = 'User successfully changed!';
        $data['action'] = 'update';
        $params = '?' . http_build_query($data);
        header('location: ../../pages/secure/admin/user.php' . $params);
    }
    else {
        header('location: ../../pages/secure/admin/');
    }
}

function updateProfile($req)
{
    $data = validatedUser($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: ../../pages/secure/user/profile.php' . $params);
    } else {
        // Adicione a lógica para lidar com o upload da imagem
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($_FILES['avatar']['tmp_name']);
            $imageBase64 = base64_encode($imageData);
            $data['avatar'] = $imageBase64;
        } else {
            $data['avatar'] = null;
        }

        $user = user();
        $data['id'] = $user['id'];
        $data['admin'] = $user['admin'];

        $success = updateUser($data);
        unset($data['avatar']);

        if ($success) {
            $_SESSION['success'] = 'User successfully changed!';
            $_SESSION['action'] = 'update';
            $params = '?' . http_build_query($data);
            header('location: ../../pages/secure/user/profile.php' . $params);
        }
    }
}


function updateUserbyADM($req)
{
    $data = validatedUser($req);

    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: ../../pages/secure/admin/update_user.php' . $params);
        } else {
        $user = user(); 
        $data['id'] = $user['id'];
        $data['admin'] = $user['admin'];

        $success = updateUser($data);

        if ($success) {
            $_SESSION['success'] = 'User successfully changed!';
            $_SESSION['action'] = 'update';
            $params = '?' . http_build_query($data);
            header('location: ../../pages/secure/admin/update_user.php' . $params);
        }
    }
}

function changePassword($req)
{
    $data = passwordIsValid($req);
    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: ../../pages/secure/user/password.php' . $params);
    } else {
        $data['id'] = userId();
        $success = updatePassword($data);
        if ($success) {
            $_SESSION['success'] = 'Password successfully changed!';
            header('location: ../../pages/secure/user/password.php');
        }
    }
}

function delete_user($user)
{
    if (isset($user['id'])) {
        $data = deleteUser($user['id']);


        if ($data) {
       
            logout();
        }

        return $data;
    } else {
        return false;
    }
}

