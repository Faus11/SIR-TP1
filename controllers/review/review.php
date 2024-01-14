<?php

require_once __DIR__ . '/../../infra/repositories/reviewRepository.php';



if (isset($_POST['review'])) {
    if ($_POST['review'] == 'create') {
        create($_POST);
    }

    if ($_POST['review'] == 'update') {
        update($_POST);
    }

    if ($_POST['review'] == 'delete') {
        delete($_POST);
    }
  
   
}

function create($data)

{
    $success = createReview($data);
    
    if ($success) {
        $_SESSION['success'] = 'Comment criado com sucesso!';
        
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['errors'] = ['Erro ao criar'];
        header('Location: ../../pages/secure/index.php');
    }
}



function update($data)
{

     $success = updateReview($data);
   if ($success) {
        $_SESSION['success'] = 'Conteúdo atualizado com sucesso!';
        header('location: ../../pages/secure/category.php');
     } else {
        $_SESSION['errors'] = ['Erro ao atualizar conteúdo'];
         header('location: ../../pages/secure/index.php');
     }
}

function delete($data)
{
    $success = deleteReview($data['id_review']);
    if ($success) {
        $_SESSION['success'] = 'Conteúdo excluído com sucesso!';
        
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['errors'] = ['Erro ao excluir conteúdo'];
        header('Location: ../../pages/secure/content.php');
    }
}

