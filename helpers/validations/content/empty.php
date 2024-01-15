<?php

function isNotEmpty($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

   if (empty($req['title']) ) {
        $errors['title'] = 'The Title field cannot be empty .';
    }
    if (empty($req['restricted']) ) {
        $errors['restricted'] = 'The Restricted field cannot be empty .';
    }
    if (empty($req['seasons']) ) {
        $errors['seasons'] = 'The Seasons field cannot be empty .';
    }
   

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}