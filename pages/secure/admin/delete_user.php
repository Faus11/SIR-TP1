<?php
// delete_user.php

require_once __DIR__ . '/../../../infra/repositories/userRepository.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        if (deleteUser($id)) {
            // Redireciona para a página principal após a exclusão bem-sucedida
            header('Location: index.php');
            exit();
        } else {
            echo "Erro ao excluir o usuário.";
        }
    }
}
?>
