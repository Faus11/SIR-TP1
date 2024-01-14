<?php

require_once __DIR__ . '/../../helpers/session.php';

if (isset($_SESSION['id']) || isset($_COOKIE['id'])) {
    header('Location: ../../');
}
