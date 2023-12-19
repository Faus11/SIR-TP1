<?php
require_once __DIR__ . '../../db/connection.php';
require_once __DIR__ . '/contentRepository.php';

function createShare($share)
{
    $sqlCreate = "INSERT INTO 
        share_content (
            receiver_user_id, 
            sharer_user_id,
            content_id, 
            created_at,
            updated_at) 
        VALUES (
            :receiver_user_id, 
            :sharer_user_id,
            :content_id, 
             NOW(), 
             NOW()
        )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':receiver_user_id' => $share['receiver_user_id'],
        ':sharer_user_id' => $share['sharer_user_id'],
        ':content_id' => $share['content_id'],
    ]);

    if ($success) {
        duplicateContentForUser($share['content_id'], $share['receiver_user_id']); 

    return $success;
}
}


function deleteShare($shareId)
{
    $sqlDelete = "DELETE FROM share_content WHERE id_share = :id_share";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlDelete);

    return $PDOStatement->execute([
        ':id_share' => $shareId, 
    ]);
}

function getAllShare()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM share_content;');
    $share = [];
    while ($listaDeshare = $PDOStatement->fetch()) {
        $share[] = $listaDeshare;
    }
    return $share;
}

function duplicateContentForUser($contentId, $receiverUserId)
{
    $contentInfo = getInfoByIdContent($contentId); 

    if ($contentInfo) {
        $newContent = [
            'title' => $contentInfo['title'],
            'restricted' => $contentInfo['restricted'],
            'image' => $contentInfo['image'],
            'seasons' => $contentInfo['seasons'],
            'release_date' => $contentInfo['release_date'],
            'end_date' => $contentInfo['end_date'],
            'description' => $contentInfo['description'],
            'cast' => $contentInfo['cast'],
            'trailer' => $contentInfo['trailer'],
            'category_id' => $contentInfo['category_id'],
            'format_id' => $contentInfo['format_id'],
            'user_id' => $receiverUserId, 
        ];

        return createContent($newContent); 
    }

    return false;
}
function getUserIdByEmail($email)
{
    $sql = "SELECT id FROM users WHERE email = :email";
    $stmt = $GLOBALS['pdo']->prepare($sql);
    $stmt->execute([':email' => $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['id'];
    }

    return null;
}


