<?php
session_start();
require_once __DIR__ . '/../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../helpers/validations/app/validate-login-password.php';

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

    if ($user && !$user['deleted_at'])
    { 
        doLogin($data);
    } elseif ($user['deleted_at']) {
        $_SESSION['errors'] = "Usuário eliminado. Não é possível fazer login.";
        $params = '?' . http_build_query($req);
        header('location: /SIR-TP1/pages/public/signin.php' . $params);
    }

}

function checkErrors($data, $req)
{
    if (isset($data['invalid'])) {
        $_SESSION['errors'] = $data['invalid'];
        $params = '?' . http_build_query($req);
        header('location: /SIR-TP1/pages/public/signin.php' . $params);
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

    if ($isAdmin) {
        $admin_url = 'http://' . $_SERVER['HTTP_HOST'] . '/SIR-TP1/pages/secure/index.php';
        header('Location: ' . $admin_url);
    } else {
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/SIR-TP1/pages/secure/index.php';
        header('Location: ' . $home_url);
    }
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

    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/SIR-TP1';
    header('Location: ' . $home_url);
}
