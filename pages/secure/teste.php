<?php
    require_once DIR . '../../../middlewares/middleware-user.php';
    @require_once DIR . '../../../validations/session.php';
    $user = user();

    $sideBTN = TRUE;
    include_once DIR . '/../templates/header.php';
    $title = 'Dashboard';
?>