<?php
session_start();
require_once '../../infra/repositories/userRepository.php';
require_once '../../helpers/validations/app/validate-login-password.php';

if (isset($_POST['user'])) {
    if ($_POST['user'] == 'login') {
        login($_POST);
    }

    if ($_POST['user'] == 'logout') {
        logout();
    }
}

function login($req)
{
    $data = isLoginValid($req);
    $valido = checkErrors($data, $req);

    if ($valido) {
        $data = isPasswordValid($data);
    }

    $user = checkErrors($data, $req);

    if ($user && $user['deleted_at'] === NULL) { 
        doLogin($data);
    } elseif ($user['deleted_at'] !== NULL) {
        $_SESSION['errors'] = "User deleted.";
        $params = '?' . http_build_query($req);
        header('location: ../../pages/public/signin.php' . $params);
        exit; 
    }
}


function checkErrors($data, $req)
{
    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: ../../pages/public/signin.php' . $params);
        return false;
    }

    unset($_SESSION['errors']);
    return true;
}

function doLogin($data)
{
 
    $isAdmin = $data['admin'];

    $_SESSION['id'] = $data['id'];
    $_SESSION['firstname'] = $data['firstname'];

    setcookie("id", $data['id'], time() + (60 * 60 * 24 * 30), "/");
    setcookie("firstname", $data['firstname'], time() + (60 * 60 * 24 * 30), "/");
    
    header('Location: ../../pages/secure/index.php');
}

function logout()
{
    if (isset($_SESSION['id'])) {

        $_SESSION = array();

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600);
        }
        session_destroy();
    }

    setcookie('id', '', time() - 3600, "/");
    setcookie('firstname', '', time() - 3600, "/");

    header('Location: ../../');
}
