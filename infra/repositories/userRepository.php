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
            avatar,
            admin,
            created_at,
            updated_at
        ) 
        VALUES (
            :firstname, 
            :lastname,
            :username,
            :phoneNumber, 
            :email, 
            :birthdate, 
            :pass, 
            :avatar,
            :admin,
            NOW(),    
            NOW()      
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
        ':avatar' => $user['avatar'],
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

function getByEmail($email, $currentUserId = null)
{
    $sql = 'SELECT * FROM users WHERE email = ?';
    $params = [$email];

    if ($currentUserId !== null) {
        $sql .= ' AND id != ?';
        $params[] = $currentUserId;
    }

    $sql .= ' LIMIT 1;';

    $PDOStatement = $GLOBALS['pdo']->prepare($sql);
    $PDOStatement->execute($params);
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
    $params = [
        ':firstname' => $user['firstname'],
        ':lastname' => $user['lastname'],
        ':username' => $user['username'],
        ':phoneNumber' => $user['phoneNumber'],
        ':email' => $user['email'],
        ':birthdate' => $user['birthdate'],
        ':avatar' => $user['avatar'],
        ':admin' => $user['admin'],
        ':id' => $user['id']
    ];

    if (isset($user['pass']) && !empty($user['pass'])) {
        $user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);
        $params[':pass'] = $user['pass'];

        $sqlUpdate = "UPDATE  
            users SET
            firstname = :firstname, 
            lastname = :lastname,
            username = :username, 
            phoneNumber = :phoneNumber, 
            email = :email, 
            birthdate = :birthdate, 
            pass = :pass,
            avatar = :avatar, 
            admin = :admin,
            updated_at = NOW()
            WHERE id = :id;";
    } else {
        $sqlUpdate = "UPDATE  
            users SET
            firstname = :firstname, 
            lastname = :lastname,
            username = :username, 
            phoneNumber = :phoneNumber, 
            email = :email, 
            birthdate = :birthdate,
            avatar = :avatar, 
            admin = :admin,
            updated_at = NOW()
            WHERE id = :id;";
    }

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);
    return $PDOStatement->execute($params);
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
            deleted_at = NOW(),
            email = NULL
        WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $id,
    ]);
}


function createNewUser($user)
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
        created_at  
    ) 
    VALUES (
        :firstname,
        :lastname,
        :username,
        :phoneNumber, 
        :email,
        :birthdate,
        :pass, 
        :created_at 
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
        ':created_at' => $user['created_at']
    ]);

    if ($success) {
        $user['id'] = $GLOBALS['pdo']->lastInsertId();
        return $user;
    }

    return false;
}

function getCurrentUserId()
{
  
    if (isset($_SESSION['user']['id'])) {
        return $_SESSION['user']['id'];
    }

    return null;   
}
function countUsers($isAdmin = null)
{
    $sql = 'SELECT COUNT(*) AS user_count FROM users';

    if ($isAdmin !== null) {
        $sql .= ' WHERE admin = :isAdmin';
    }

    $PDOStatement = $GLOBALS['pdo']->prepare($sql);

    if ($isAdmin !== null) {
        $PDOStatement->bindParam(':isAdmin', $isAdmin, PDO::PARAM_INT);
    }

    $PDOStatement->execute();
    $result = $PDOStatement->fetch(PDO::FETCH_ASSOC);

    return $result['user_count'];
}


