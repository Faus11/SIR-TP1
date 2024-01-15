<?php
require_once __DIR__ . '../../db/connection.php';

function createContent($visualContent)

{
    
    
    $sqlCreate = "INSERT INTO 
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
        NOW(),    
        NOW(),
        :category_id,
        :format_id,
        :user_id
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    

    $success= $PDOStatement->execute([
        ':title' => $visualContent['title'],
        ':restricted' => $visualContent['restricted'],
        ':image' => $visualContent['image'],
        ':seasons' => $visualContent['seasons'],
        ':release_date' => $visualContent['release_date'],
        ':end_date' => $visualContent['end_date'],
        ':description' => $visualContent['description'],
        ':cast' => $visualContent['cast'],
        ':trailer' => $visualContent['trailer'],
        ':category_id' => $visualContent['category_id'],
        ':format_id' => $visualContent['format_id'],
        ':user_id' => $visualContent['user_id']

    ]);

    if ($success) {
        $visualContent['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}
function getAllContent()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM visual_content;');
    $visualContent = [];
    while ($listaDecontent = $PDOStatement->fetch()) {
        $visualContent[] = $listaDecontent;
    }
    return $visualContent;
}

function updateContent($visualContent)
{
    $params = [
        ':title' => $visualContent['title'],
        ':restricted' => $visualContent['restricted'],
        ':image' => $visualContent['image'],
        ':seasons' => $visualContent['seasons'],
        ':release_date' => $visualContent['release_date'],
        ':end_date' => $visualContent['end_date'],
        ':description' => $visualContent['description'],
        ':cast' => $visualContent['cast'],
        ':trailer' => $visualContent['trailer'],
        ':category_id' => $visualContent['category_id'],
        ':format_id' => $visualContent['format_id'],
        ':user_id' => $visualContent['user_id'],
        ':id' => $visualContent['id']
    ];


    $sqlUpdate = "UPDATE visual_content SET
    title = :title, 
    restricted = :restricted,
    image = :image,
    seasons = :seasons,
    release_date = :release_date, 
    end_date = :end_date, 
    description = :description,
    cast = :cast,
    trailer = :trailer,
    category_id = :category_id,
    format_id = :format_id,
    user_id = :user_id,
    updated_at = NOW()
    WHERE id = :id";


    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);
    return $PDOStatement->execute($params);
}

function deleteContent($contentId)
{
    $sqlUpdate = "UPDATE visual_content SET deleted_at = NOW() WHERE id = :id";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $contentId, 
    ]);
}



function createNewContent($visualContent)
{
    $user['created_at'] = date('Y-m-d H:i:s'); 

    $sqlCreate = "INSERT INTO 
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
        :category_id,
        :format_id,
        :user_id
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
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
        ':category_id' => $visualContent['category_id'],
        ':format_id' => $visualContent['format_id'],
        ':user_id' => $visualContent['user_id']
    ]);

    if ($success) {
        $visualContent['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;
}
function getContentByUserId($userId)
{
    $sql = "SELECT * FROM visual_content WHERE user_id = :user_id";
    $PDOStatement = $GLOBALS['pdo']->prepare($sql);
    $PDOStatement->execute([':user_id' => $userId]);

    $visualContent = [];
    while ($content = $PDOStatement->fetch()) {
        $visualContent[] = $content;
    }

    return $visualContent;
}

function getContentByUserIdAndCategory($userId)
{
    $sql = "SELECT * FROM visual_content WHERE user_id = :user_id AND deleted_at IS NULL";
    $PDOStatement = $GLOBALS['pdo']->prepare($sql);
    $PDOStatement->execute([':user_id' => $userId]);

    $visualContentByCategory = [];
    while ($content = $PDOStatement->fetch()) {
        $category_id = $content['category_id'];
        if (!isset($visualContentByCategory[$category_id])) {
            $visualContentByCategory[$category_id] = [];
        }
        $visualContentByCategory[$category_id][] = $content;
    }

    return $visualContentByCategory;
}
function getCategoryNameById($categoryId) {
    
    $categories = [
        1 => 'Drama',
        2 => 'Romance',
        3 => 'Action',
        4 => 'Comedy',
        5 => 'Adventure',
        6 => 'Terror',
        7 => 'Science Fiction',
        8 => 'Crime',
        9 => 'Animation',
        10 => 'Thriller',
        11 => 'Spernatural',
        12 => 'Sports',
        
      
    ];

   
    return $categories[$categoryId] ?? 'Unknown';
}

function getInfoByIdContent($contentId)
{
    $sql = "SELECT * FROM visual_content WHERE id = :id";
    $PDOStatement = $GLOBALS['pdo']->prepare($sql);
    $PDOStatement->execute([':id' => $contentId]);

    return $PDOStatement->fetch();
}

function getByIdContent($contentId)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM visual_content WHERE id = ?;');
    $PDOStatement->bindValue(1, $contentId, PDO::PARAM_INT); 
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function insertEndDate($contentId, $endDate)
{
    $checkSql = "SELECT COUNT(*) AS count FROM visual_content WHERE id = :id AND end_date IS NULL";
    $checkStatement = $GLOBALS['pdo']->prepare($checkSql);
    $checkStatement->execute([':id' => $contentId]);
    $result = $checkStatement->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        $sql = "UPDATE visual_content SET end_date = :end_date WHERE id = :id";
        $PDOStatement = $GLOBALS['pdo']->prepare($sql);
        $success = $PDOStatement->execute([':end_date' => $endDate, ':id' => $contentId]);
        return $success;
    }

    return false; 
}
function removeEndDate($contentId)
{
    $sql = "UPDATE visual_content SET end_date = NULL WHERE id = :id";
    $PDOStatement = $GLOBALS['pdo']->prepare($sql);
    $success = $PDOStatement->execute([':id' => $contentId]);
    return $success;
}


function getTitleByName($title)
{
    $sql = "SELECT title FROM visual_content WHERE title LIKE :title";
    $PDOStatement = $GLOBALS['pdo']->prepare($sql);
    $PDOStatement->bindValue(':title', "%$title%", PDO::PARAM_STR);
    $PDOStatement->execute();

    $titles = [];
    while ($result = $PDOStatement->fetch(PDO::FETCH_ASSOC)) {
        $titles[] = $result['title'];
    }

    return $titles;


    
}
    function countContents()
    {
        $PDOStatement = $GLOBALS['pdo']->query('SELECT COUNT(*) AS content_count FROM visual_content;');
        $result = $PDOStatement->fetch(PDO::FETCH_ASSOC);
        return $result['content_count'];
    }

    function getSearchedShows($searchInput, $user_id)
    {
        $sql = 'SELECT id FROM visual_content WHERE user_id = :user_id AND title LIKE :searchInput AND deleted_at IS NULL';
    
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $searchTermWithWildcards = '%' . $searchInput . '%';
        $stmt->bindParam(':searchInput', $searchTermWithWildcards, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }
    