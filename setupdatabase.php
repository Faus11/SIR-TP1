<?php
#EASY DATABASE SETUP
require __DIR__ . '/infra/db/connection.php';

#DROP TABLES
$pdo->exec('DROP TABLE IF EXISTS users;');
echo 'Table users deleted!' . PHP_EOL;

$pdo->exec('DROP TABLE IF EXISTS Role;');
echo 'Table Role deleted!' . PHP_EOL;

#CREATE TABLE Role
$pdo->exec(
    'CREATE TABLE Role (
    id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    role_name varchar(50),
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
    );'
);
echo 'Table Role created!' . PHP_EOL;

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
    id_role INTEGER UNSIGNED,
    FOREIGN KEY (id_role) REFERENCES Role(id),
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    deleted_at timestamp NULL DEFAULT NULL
    );'
);

echo 'Table users created!' . PHP_EOL;


#DEFAULT USER TO ADD
$user = [
    'firstname' => 'Nelo',
    'lastname' => 'Chapeiro',
    'username' => 'queXedeMoce',
    'phoneNumber' => '966123123',
    'email' => 'nelochapa@gmail.com',
    'birthdate' => '1980-10-09',
    'pass' => '123456',
    'id_role' => 1, 
    'created_at' => null,
    'updated_at' => null, 
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
        id_role,
        created_at,
        updated_at,
        deleted_at) 
    VALUES (
        :firstname, 
        :lastname,
        username,
        :phoneNumber, 
        :email, 
        :birthdate, 
        :pass,
        :id_role, 
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
    ':id_role' => $user['id_role'],
    ':created_at' => $user['created_at'],
    ':updated_at' => $user['updated_at'],
    ':deleted_at' => $user['deleted_at']
]);


echo 'Default user created!';