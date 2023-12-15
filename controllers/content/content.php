<?php

require_once __DIR__ . '/../../infra/repositories/contentRepository.php';



if (isset($_POST['content'])) {
    if ($_POST['content'] == 'create') {
        create($_POST);
    }

    if ($_POST['content'] == 'update') {
        update($_POST);
    }

    if ($_POST['content'] == 'delete') {
        delete($_POST);
    }
  
}

function create($data)
{
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $data12 = file_get_contents($_FILES['image']['tmp_name']);
        $receiptImageEncoded = base64_encode($data12);
        $data['image'] = $receiptImageEncoded;
    } else {
        $data['image'] = null;
    }

    $success = createContent($data);
    

    if ($success) {
        $_SESSION['success'] = 'Conteúdo criado com sucesso!';
        header('location: /SIR-TP1/pages/secure/content.php');
    } else {
        $_SESSION['errors'] = ['Erro ao criar conteúdo'];
        header('location: /SIR-TP1/pages/secure/content.php');
    }
}

function update($data)
{

     $success = updateContent($data);
   if ($success) {
        $_SESSION['success'] = 'Conteúdo atualizado com sucesso!';
        header('location: /SIR-TP1/pages/secure/content.php');
     } else {
        $_SESSION['errors'] = ['Erro ao atualizar conteúdo'];
         header('location: /SIR-TP1/pages/secure/content.php');
     }
}

function delete($data)
{
    $success = deleteContent($data['id']);
     if ($success) {
        $_SESSION['success'] = 'Conteúdo excluído com sucesso!';
        
        header('Location: /SIR-TP1/pages/secure/categories.php');
    } else {
         $_SESSION['errors'] = ['Erro ao excluir conteúdo'];
         header('location: /SIR-TP1/pages/secure/content.php');
     }
}