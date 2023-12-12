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
        created_at,
        updated_at,
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
        NOW(),    
        NOW(),
        :category_id,
        :format_id
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
        ':category_id' => $visualContent['category_id'],
        ':format_id' => $visualContent['format_id']
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
        ':category_id' => $visualContent['category_id'],
        ':format_id' => $visualContent['format_id'],
        ':id' => $visualContent['id']
    ];


        $sqlUpdate = "UPDATE  
           visual_content SET
            :title = :title, 
            :restricted= :restricted,
            :image = :image,
            :seasons = :seasons,
            :release_date = :release_date, 
            :end_date = :end_date, 
            :description = :description,
            :cast = :cast,
            updated_at = NOW()    
            :category_id = :category_id,
            :format_id = :format_id
            WHERE id = :id;";
        

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);
    return $PDOStatement->execute($params);
}

function deleteContent($id)
{
    $sqlUpdate = "UPDATE
        visual_content SET
            deleted_at = NOW()
        WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $id,
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
        created_at,
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
        :category_id,
        :format_id
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
        ':created_at' => $visualContent['created_at'],
        ':category_id' => $visualContent['category_id'],
        ':format_id' => $visualContent['format_id']
    ]);

    if ($success) {
        $visualContent['id'] = $GLOBALS['pdo']->lastInsertId();
    }
    return $success;

}