<?php

function isSignUpValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['firstname']) || strlen($req['firstname']) < 3 || strlen($req['firstname']) > 255) {
        $errors['firstname'] = 'The name field cannot be empty and must be between 3 and 255 characters';
    }

    if (!filter_var($req['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'The Email field must not be empty and must have an email format, such as: name@example.com.';
    }

    if (getByEmail($req['email'])) {
        $errors['email'] = 'Email already registered in our system. If you cannot remember your password, please contact us.';
        return ['invalid' => $errors];
    }

    if (empty($req['pass']) && strlen($req['pass']) < 6) {
        $errors['pass'] = 'The Password field cannot be empty and must be at least 6 characters long.';
    }

    if ($req['confirm_password'] != $req['pass']) {
        $errors['confirm_password'] = 'The Confirm Password field must not be empty and must be the same as the Password field.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}

?>