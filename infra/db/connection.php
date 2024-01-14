<?php

try {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'id21790893_sir';
    $DATABASE_PASS = 'Temquedar123!';
    $DATABASE_NAME = 'id21790893_sir';

    $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Ups! Cannot connect do db 😭";
    echo $e->getMessage();
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    exit();
}
