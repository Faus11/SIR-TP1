<?php
require_once __DIR__ . '../../db/connection.php';

function createUser($user)
{
    $user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);
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
        updated_at) 
    VALUES (
        :firstname, 
        :lastname,
        :username 
        :phoneNumber, 
        :email, 
        :birthdate, 
        :pass, 
        :admin,
        :NOW(),
        :NOW()
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':firstname' => $user['firstname'],
        ':lastname' => $user['lastname'],
        ':username' => $user['username'],
        ':phoneNumber' => $user['phoneNumber'],
        ':email' => $user['email'],
        ':birthdate' => $user['birthdate'],
        ':pass' => $user['pass'],
        ':admin' => $user['admin']
    ]);

    if ($success) {
        $user['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}

function getById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM users WHERE id = ?;');
    $PDOStatement->bindValue(1, $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getByEmail($email)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM users WHERE email = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $email);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getAll()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM users;');
    $users = [];
    while ($listaDeusers = $PDOStatement->fetch()) {
        $users[] = $listaDeusers;
    }
    return $users;
}

function updateUser($user)
{
    if (isset($user['pass']) && !empty($user['pass'])) {
        $user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);

        $sqlUpdate = "UPDATE  
        users SET
            firstname = :firstname, 
            lastname = :lastname,
            username = username, 
            phoneNumber = :phoneNumber, 
            email = :email, 
            birthdate = :birthdate, 
            pass = :pass, 
            admin = :admin,
            updated_at = NOW()
        WHERE id = :id;";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':firstname' => $user['firstname'],
            ':lastname' => $user['lastname'],
            ':username' => $user['username'],
            ':phoneNumber' => $user['phoneNumber'],
            ':email' => $user['email'],
            ':birthdate' => $user['birthdate'],
            ':pass' => $user['pass'],
            ':admin' => $user['admin']
        ]);
    }

    $sqlUpdate = "UPDATE  
    users SET
            firstname = :firstname, 
            lastname = :lastname,
            username = username, 
            phoneNumber = :phoneNumber, 
            email = :email, 
            birthdate = :birthdate, 
            pass = :pass, 
            admin = :admin
    WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
            ':firstname' => $user['firstname'],
            ':lastname' => $user['lastname'],
            ':username' => $user['username'],
            ':phoneNumber' => $user['phoneNumber'],
            ':email' => $user['email'],
            ':birthdate' => $user['birthdate'],
            ':pass' => $user['pass'],
            ':admin' => $user['admin']
    ]);
}

function updatePassword($user)
{
    if (isset($user['pass']) && !empty($user['pass'])) {
        $user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);

        $sqlUpdate = "UPDATE  
        users SET 
            pass = :pass,
            updated_at = NOW()
        WHERE id = :id;";

        $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

        return $PDOStatement->execute([
            ':id' => $user['id'],
            ':pass' => $user['pass']
        ]);
    }
}

function deleteUser($id)
{
    $sqlUpdate = "UPDATE
        users SET
            deleted_at = NOW()
        WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $id,
    ]);
}

function createNewUser($user)
{
    $user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);
    $user['admin'] = false;
    $sqlCreate = "INSERT INTO 
    users (
        firstname,
        lastname,
        username,
        phoneNumber, 
        email,
        birthdate,
        pass, 
        admin) 
    VALUES (
        :firstname,
        :lastname,
        :username,
        :phoneNumber, 
        :email,
        :birthdate,
        :pass, 
        :admin
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':firstname' => $user['firstname'],
        ':lastname' => $user['lastname'],
        ':username' => $user['username'],
        ':phoneNumber' => $user['phoneNumber'],
        ':email' => $user['email'],
        ':birthdate' => $user['birthdate'],
        ':pass' => $user['pass'],
        ':admin' => $user['admin']
    ]);

    if ($success) {
        $user['id'] = $GLOBALS['pdo']->lastInsertId();
        return $user;
    }

    return false;
}
