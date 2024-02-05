<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';
require_once __DIR__ . '/../../helpers/validations/content/empty.php';
require_once __DIR__ . '/../../helpers/validations/calendarize/date.php';



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
    if ($_POST['content'] == 'add_date') {
        addEndDate($_POST); 
    }
    if ($_POST['content'] == 'delete_date') {
        deleteEndDate($_POST); 
    }
   
}

function create($data)
{
    $validatedData = isNotEmpty($data);

    if (isset($validatedData['invalid'])) {
        $_SESSION['errors'] = $validatedData['invalid'];
  
        $params = '?' . http_build_query($data);
        header('location: ../../pages/secure/content.php' . $params);
        exit();
    }

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
        header('location: ../../pages/secure/content.php');
    } else {
        $_SESSION['errors'] = ['Erro ao criar conteúdo'];
      
        $params = '?' . http_build_query($data);
        header('location: ../../pages/secure/content.php' . $params);
    }
}



function update($data)
{
    $validatedData = isNotEmpty($data);

    if (isset($validatedData['invalid'])) {
        $_SESSION['errors'] = $validatedData['invalid'];
  
        $params = '?' . http_build_query($data);
        header('location: ../../pages/secure/updateContent.php' . $params);
        exit();
    }
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $data12 = file_get_contents($_FILES['image']['tmp_name']);
        $receiptImageEncoded = base64_encode($data12);
        $data['image'] = $receiptImageEncoded;
    } else {
        $data['image'] = null;
    }
     $success = updateContent($data);
   if ($success) {
        $_SESSION['success'] = 'Conteúdo atualizado com sucesso!';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
     } else {
        $_SESSION['errors'] = ['Erro ao atualizar conteúdo'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
     }
}

function delete($data)
{
    $success = deleteContent($data['id']);
    if ($success) {
        
        
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['errors'] = ['Erro ao excluir conteúdo'];
        header('Location: ../../pages/secure/content.php');
    }
}
function addEndDate($data)
{
    $contentId = $_POST['id']; 
    $endDate = $data['end_date']; 

    
    $validatedData = validDate(['end_date' => $endDate]);

    if (isset($validatedData['invalid'])) {
        $_SESSION['errors'] = $validatedData['invalid'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $success = insertEndDate($contentId, $endDate);

    if ($success) {
        $_SESSION['success'] = 'Data de término adicionada com sucesso!';
    } else {
        $_SESSION['errors'] = ['Erro ao adicionar a data de término.'];
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


function deleteEndDate($data)
{
    $contentId = $_POST['id']; 

    $success = removeEndDate($contentId);

    if ($success) {
        $_SESSION['success'] = 'Data de término removida com sucesso!';
    } else {
        $_SESSION['errors'] = ['Erro ao remover a data de término.'];
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_GET['submitSearch'])) { 
        $searchInput = trim($_GET['searchInput']);
        $user_id = ($_GET['user_id']);

        if (!empty($searchInput)) {
            getShows($searchInput, $user_id);
        }
        else{
            header('Location: ../../pages/secure/index.php');
        }
    }


function getShows($searchInput, $user_id)
{
    $searchResults = getSearchedShows($searchInput, $user_id);
    
    if ($searchResults) {
        $searchResultsJson = json_encode($searchResults);

        $params = '?searchResults=' . urlencode($searchResultsJson);
        header('Location: ../../pages/secure/searchResults.php' . $params);
        exit;
    } else {
       
        header('Location: ../../pages/secure/searchResults.php');
        exit;
    }
}




