<?php
#EASY DATABASE SETUP
require __DIR__ . '/infra/db/connection.php';


$tablesToCheck = ['users','visual_content','content_format','category_format', 'content_review' ]; 
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
    $tablesToDrop = ['users','visual_content','content_format','category_format', 'content_review']; 

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
        end_date date NULL, 
        description varchar(200),
        cast varchar(200),
        trailer LONGTEXT NULL,
        created_at timestamp NULL DEFAULT NULL,
        updated_at timestamp NULL DEFAULT NULL,
        deleted_at timestamp NULL DEFAULT NULL,
        category_id INTEGER UNSIGNED, 
        format_id INTEGER UNSIGNED,
        user_id INTEGER UNSIGNED,
        CONSTRAINT visual_content_category_id_foreign FOREIGN KEY (category_id) REFERENCES category_format(id),
        CONSTRAINT visual_content_format_id_foreign FOREIGN KEY (format_id) REFERENCES content_format(id),
        CONSTRAINT visual_content_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id)
    );'
);

#CREATE TABLE content_review
$pdo->exec(
    'CREATE TABLE content_review (
        id_review INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
        comment text, 
        rating INTEGER, 
        date_hour date, 
        created_at timestamp NULL DEFAULT NULL,
        updated_at timestamp NULL DEFAULT NULL,
        content_id INTEGER UNSIGNED,
        user_id INTEGER UNSIGNED,
        CONSTRAINT content_review_content_id_foreign FOREIGN KEY (content_id) REFERENCES visual_content(id),
        CONSTRAINT content_review_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id)
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





$contentFormats = [
    ['name' => 'TV Show'],
    ['name' => 'Movie'],
    ['name' => 'Documentary'],
    ['name' => 'Short Film'],
    ['name' => 'Series']
    
];

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

$PDOStatementContentFormat = $GLOBALS['pdo']->prepare($sqlCreateContentFormat);

foreach ($contentFormats as $format) {
    $format['created_at'] = date('Y-m-d H:i:s');
    $format['updated_at'] = date('Y-m-d H:i:s');
    $format['deleted_at'] = null;

    $successContentFormat = $PDOStatementContentFormat->execute([
        ':name' => $format['name'],
        ':created_at' => $format['created_at'],
        ':updated_at' => $format['updated_at'],
        ':deleted_at' => $format['deleted_at']
    ]);
}


$categoryFormats = [
    ['name' => 'Drama'],
    ['name' => 'Romance'],
    ['name' => 'Action'],
    ['name' => 'Comedy'],
    ['name' => 'Adventure'],
    ['name' => 'Terror'],
    ['name' => 'Science Fiction'],
    ['name' => 'Crime'],
    ['name' => 'Animation'],
    ['name' => 'Thriller'],
    ['name' => 'Supernatural'],
    ['name' => 'Sports']
];

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

$PDOStatementCategoryFormat = $GLOBALS['pdo']->prepare($sqlCreateCategoryFormat);

foreach ($categoryFormats as $category) {
    $category['created_at'] = date('Y-m-d H:i:s');
    $category['updated_at'] = date('Y-m-d H:i:s');
    $category['deleted_at'] = null;

    $successCategoryFormat = $PDOStatementCategoryFormat->execute([
        ':name' => $category['name'],
        ':created_at' => $category['created_at'],
        ':updated_at' => $category['updated_at'],
        ':deleted_at' => $category['deleted_at']
    ]);
}



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
    'trailer' => 'https://www.youtube.com/watch?v=pgSyI2_fLHo&pp=ygUUbGluayBhd2Vzb21lIHR2IHNob3c%3D',
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
    'deleted_at' => null,
    'category_id' => 1, 
    'format_id' => 1,
    'user_id' => 1,


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
        trailer,
        created_at,
        updated_at,
        deleted_at,
        category_id,
        format_id,
        user_id
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
        :trailer,
        :created_at,
        :updated_at,
        :deleted_at,
        :category_id,
        :format_id,
        :user_id
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
    ':trailer' => $visualContent['trailer'],
    ':created_at' => $visualContent['created_at'],
    ':updated_at' => $visualContent['updated_at'],
    ':deleted_at' => $visualContent['deleted_at'],
    ':category_id' => $visualContent['category_id'],
    ':format_id' => $visualContent['format_id'],
    ':user_id' => $visualContent['user_id']


]);

#DEFAULT REVIEW TO ADD
$review = [
    'comment' => 'Serie mt top recomendo',
    'rating' => 5,
    'date_hour' => date('Y-m-d H:i:s'),
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
    'content_id' => 1,
    'user_id' => 1

    
];



#INSERT REVIEW
$sqlCreate = "INSERT INTO 
    content_review (
        comment, 
        rating,
        date_hour, 
        created_at,
        updated_at,
        content_id,
        user_id) 
    VALUES (
        :comment, 
        :rating,
        :date_hour, 
        :created_at,
        :updated_at,
        :content_id,
        :user_id
    )";


#PREPARE QUERY
$PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

#EXECUTE
$success = $PDOStatement->execute([
    ':comment' => $review['comment'],
    ':rating' => $review['rating'],
    ':date_hour' => $review['date_hour'],
    ':created_at' => $review['created_at'],
    ':updated_at' => $review['updated_at'],
    ':content_id' => $review['content_id'],
    ':user_id' => $review['user_id']
]);
}
