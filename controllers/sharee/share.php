<?php

require_once __DIR__ . '/../../infra/repositories/shareRepository.php';



if (isset($_POST['share'])) {
    if ($_POST['share'] == 'create') {
        create($_POST);
    }

    if ($_POST['share'] == 'delete') {
        delete($_POST);
    }
  
   
}

function create($data)
{
    $receiverEmail = $data['receiver_email'];
    $receiverUserId = getUserIdByEmail($receiverEmail);

    if ($receiverUserId !== null) {
        $share = [
            'receiver_user_id' => $receiverUserId,
            'sharer_user_id' => $data['sharer_user_id'],
            'content_id' => $data['content_id']
        ];

        $success = createShare($share);

        if ($success) {
            $_SESSION['success'] = 'Conteúdo partilhado com sucesso!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['errors'] = ['Erro ao partilhar conteúdo'];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    } else {
        $_SESSION['errors'] = ['Email do destinatário não encontrado'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}


function delete($data)
{
    $success = deleteShare($data['id_share']);
     if ($success) {
        $_SESSION['success'] = 'Conteúdo excluído com sucesso!';
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
         $_SESSION['errors'] = ['Erro ao excluir conteúdo'];
         header('Location: ' . $_SERVER['HTTP_REFERER']);
     }
}

