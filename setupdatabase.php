<?php
#EASY DATABASE SETUP
require __DIR__ . '/infra/db/connection.php';


$tablesToCheck = ['users','visual_content','content_format','category_format'];
$tablesExist = true;

foreach ($tablesToCheck as $table) {
    $tableExistQuery = "SHOW TABLES LIKE '$table'";
    $tableExistStatement = $pdo->query($tableExistQuery);

    if ($tableExistStatement->rowCount() === 0) {
        $tablesExist = false;
        break;
    }
}

if (!$tablesExist) {
    $tablesToDrop = ['users','visual_content','content_format','category_format'];

    foreach ($tablesToDrop as $table) {
        $pdo->exec("DROP TABLE IF EXISTS $table;");
    }



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
    avatar longblob NULL,
    admin BOOLEAN NOT NULL DEFAULT false,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    deleted_at timestamp NULL DEFAULT NULL
    );'
);
#CREATE TABLE content_format
$pdo->exec(
'CREATE TABLE content_format (
    id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name varchar(50), 
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    deleted_at timestamp NULL DEFAULT NULL
);'
);

#CREATE TABLE category_format
$pdo->exec(
    ' CREATE TABLE category_format (
        id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        name varchar(50), 
        created_at timestamp NULL DEFAULT NULL,
        updated_at timestamp NULL DEFAULT NULL,
        deleted_at timestamp NULL DEFAULT NULL
    );'
);
#CREATE TABLE category_format
$pdo->exec(
    'CREATE TABLE visual_content (
        id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
        title varchar(50), 
        restricted varchar(50), 
        image longblob NULL,
        seasons INTEGER, 
        release_date date, 
        end_date date, 
        description varchar(200),
        cast varchar(200),
        created_at timestamp NULL DEFAULT NULL,
        updated_at timestamp NULL DEFAULT NULL,
        deleted_at timestamp NULL DEFAULT NULL,
        category_id INTEGER UNSIGNED, -- Adicionando a coluna category_id
        format_id INTEGER UNSIGNED, -- Adicionando a coluna format_id
        CONSTRAINT visual_content_category_id_foreign FOREIGN KEY (category_id) REFERENCES category_format(id),
        CONSTRAINT visual_content_format_id_foreign FOREIGN KEY (format_id) REFERENCES content_format(id)
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
    'avatar' => 'NULL',
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
        avatar,
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
        :avatar,
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
    ':avatar' => $user['avatar'],
    ':admin' => $user['admin'],
    ':created_at' => $user['created_at'],
    ':updated_at' => $user['updated_at'],
    ':deleted_at' => $user['deleted_at']
]);





# DEFAULT DATA TO ADD TO content_format
$contentFormat = [
    'name' => 'TV Show', 
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
    'deleted_at' => null 
];

# INSERT INTO content_format
$sqlCreateContentFormat = "INSERT INTO 
    content_format (
        name, 
        created_at,
        updated_at,
        deleted_at
    ) 
    VALUES (
        :name, 
        :created_at,
        :updated_at,
        :deleted_at
    )";

# PREPARE QUERY
$PDOStatementContentFormat = $GLOBALS['pdo']->prepare($sqlCreateContentFormat);

# EXECUTE
$successContentFormat = $PDOStatementContentFormat->execute([
    ':name' => $contentFormat['name'],
    ':created_at' => $contentFormat['created_at'],
    ':updated_at' => $contentFormat['updated_at'],
    ':deleted_at' => $contentFormat['deleted_at']
]);

# DEFAULT DATA TO ADD TO category_format
$categoryFormat = [
    'name' => 'Drama', // Replace with the desired category format name
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
    'deleted_at' => null 
];

# INSERT INTO category_format
$sqlCreateCategoryFormat = "INSERT INTO 
    category_format (
        name, 
        created_at,
        updated_at,
        deleted_at
    ) 
    VALUES (
        :name, 
        :created_at,
        :updated_at,
        :deleted_at
    )";

# PREPARE QUERY
$PDOStatementCategoryFormat = $GLOBALS['pdo']->prepare($sqlCreateCategoryFormat);

# EXECUTE
$successCategoryFormat = $PDOStatementCategoryFormat->execute([
    ':name' => $categoryFormat['name'],
    ':created_at' => $categoryFormat['created_at'],
    ':updated_at' => $categoryFormat['updated_at'],
    ':deleted_at' => $categoryFormat['deleted_at']
]);



#DEFAULT VISUAL CONTENT TO ADD
$visualContent = [
    'title' => 'Awesome TV Show',
    'restricted' => '+12',
    'image' => 'NULL',
    'seasons' => 5,
    'release_date' => '2023-01-15',
    'end_date' => '2023-12-20',
    'description' => 'An amazing TV show with thrilling episodes.',
    'cast' => 'John Doe, Jane Smith, etc.',
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
    'deleted_at' => null,
    'category_id' => 1, 
    'format_id' => 1 
];

#INSERT VISUAL CONTENT
$sqlCreateVisualContent = "INSERT INTO 
    visual_content (
        title, 
        restricted,
        image,
        seasons,
        release_date, 
        end_date, 
        description,
        cast,
        created_at,
        updated_at,
        deleted_at,
        category_id,
        format_id
    ) 
    VALUES (
        :title, 
        :restricted,
        :image,
        :seasons,
        :release_date, 
        :end_date, 
        :description,
        :cast,
        :created_at,
        :updated_at,
        :deleted_at,
        :category_id,
        :format_id
    )";

#PREPARE QUERY
$PDOStatementVisualContent = $GLOBALS['pdo']->prepare($sqlCreateVisualContent);

#EXECUTE
$successVisualContent = $PDOStatementVisualContent->execute([
    ':title' => $visualContent['title'],
    ':restricted' => $visualContent['restricted'],
    ':image' => $visualContent['image'],
    ':seasons' => $visualContent['seasons'],
    ':release_date' => $visualContent['release_date'],
    ':end_date' => $visualContent['end_date'],
    ':description' => $visualContent['description'],
    ':cast' => $visualContent['cast'],
    ':created_at' => $visualContent['created_at'],
    ':updated_at' => $visualContent['updated_at'],
    ':deleted_at' => $visualContent['deleted_at'],
    ':category_id' => $visualContent['category_id'],
    ':format_id' => $visualContent['format_id']
]);
}
