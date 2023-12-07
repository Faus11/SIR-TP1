<?php

function passwordIsValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] = trim($req[$key]);
    }

    if (empty($req['firstname']) || strlen($req['firstname']) < 3 || strlen($req['firstname']) > 255) {
        $errors['firstname'] = 'The Name field cannot be empty and must be between 3 and 255 characters';
    }

    if (!empty($req['pass']) && strlen($req['pass']) < 6) {
        $errors['pass'] = 'The Password field cannot be empty and must be at least 6 characters long.';
    }

    if (!empty($req['confirm_password']) && ($req['confirm_password']) != $req['pass']) {
        $errors['confirm_password'] = 'The Confirm Password field must not be empty and must be the same as the Password field.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}

?>
