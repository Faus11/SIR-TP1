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
    if (empty($req['description']) ) {
        $errors['description'] = 'The description field cannot be empty .';
    }
    if (empty($req['cast']) ) {
        $errors['cast'] = 'The cast field cannot be empty .';
    }
    if (empty($req['trailer']) ) {
        $errors['trailer'] = 'The attachments field cannot be empty .';
    }
    if (empty($req['release_date']) || strtotime($req['release_date']) === false) {
        $errors['release_date'] = 'Release Date must be a valid date.';
    }
   

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}