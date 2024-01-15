<?php

function ifEmailExists($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }
      
    if (!getByEmail($email)) {
        $errors['email'] = 'Email not found in our system.';
        return ['invalid' => $errors];
    }

   
   

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}