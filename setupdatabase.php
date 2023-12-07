<?php
#EASY DATABASE SETUP
require __DIR__ . '/infra/db/connection.php';

#DROP TABLES
$pdo->exec('DROP TABLE IF EXISTS users;');



#CREATE TABLE users
$pdo->exec(
    'CREATE TABLE users (
    id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    firstname varchar(50), 
    lastname varchar(50), 
    username varchar(50),
    phoneNumber varchar(50), 
    email varchar(50) NOT NULL, 
    birthdate date, 
    pass varchar(200),
    admin BOOLEAN NOT NULL DEFAULT false,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    deleted_at timestamp NULL DEFAULT NULL
    );'
);

#DEFAULT USER TO ADD
$user = [
    'firstname' => 'Nelo',
    'lastname' => 'Chapeiro',
    'username' => 'queXedeMoce',
    'phoneNumber' => '966123123',
    'email' => 'nelochapa@gmail.com',
    'birthdate' => '1980-10-09',
    'pass' => '123456',
    'admin' => true, 
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
    'deleted_at' => null 
];

#HASH PWD
$user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);

#INSERT USER
$sqlCreate = "INSERT INTO 
    users (
        firstname, 
        lastname,
        username,
        phoneNumber, 
        email, 
        birthdate, 
        pass,
        admin,
        created_at,
        updated_at,
        deleted_at) 
    VALUES (
        :firstname, 
        :lastname,
        :username, 
        :phoneNumber, 
        :email, 
        :birthdate, 
        :pass,
        :admin, 
        :created_at,
        :updated_at,
        :deleted_at
    )";


#PREPARE QUERY
$PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

#EXECUTE
$success = $PDOStatement->execute([
    ':firstname' => $user['firstname'],
    ':lastname' => $user['lastname'],
    ':username' => $user['username'],
    ':phoneNumber' => $user['phoneNumber'],
    ':email' => $user['email'],
    ':birthdate' => $user['birthdate'],
    ':pass' => $user['pass'],
    ':admin' => $user['admin'],
    ':created_at' => $user['created_at'],
    ':updated_at' => $user['updated_at'],
    ':deleted_at' => $user['deleted_at']
]);


