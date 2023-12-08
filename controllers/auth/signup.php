<?php
session_start();

require_once __DIR__ . '/../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../helpers/validations/app/validate-sign-up.php';

if (isset($_POST['user'])) {
    if ($_POST['user'] == 'signUp') {
        signUp($_POST);
    }
}

function signUp($req)
{
    $data = isSignUpValid($req);

    if (isset($data['invalid'])) {

        $_SESSION['errors'] = $data['invalid'];

        $params = '?' . http_build_query($req);

        header('location: /SIR-TP1/pages/public/signup.php' . $params);
    } else {

        $user = createNewUser($data);

        if ($user) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['firstname'] = $user['firstname'];

            setcookie("id", $data['id'], time() + (60 * 60 * 24 * 30), "/");
            setcookie("firstname", $data['firstname'], time() + (60 * 60 * 24 * 30), "/");
            header('location: /SIR-TP1/pages/secure/index.php');
        } else {
            $_SESSION['errors'] = "User criado, mas foi eliminado. Não é possível fazer login.";
            header('location: /SIR-TP1/pages/secure/index.php');
        }
    }
}
