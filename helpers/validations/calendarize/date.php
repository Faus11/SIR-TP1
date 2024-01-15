<?php

function validDate($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

  
    if (empty($req['end_date']) || strtotime($req['end_date']) === false) {
        $errors['end_date'] = 'You must put the Date.';
    }
   

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}