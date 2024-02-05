<?php
require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user();
$title = '- App';

renderHeader($title);
renderNavbar($user);
?>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
        color: white;
    }

    .avatar-container {
        width: 150px; /* Largura fixa */
        height: 150px; /* Altura fixa */
        overflow: hidden; 
        
        margin: 0 auto; 
    }

    .avatar {
        width: 100%; 
        height: auto; 
         
    }
</style>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="rounded-box text-center mx-auto">
                <div class="avatar-container">
                    <img class="avatar" src="data:image/webp;base64,<?= $user['avatar'] ?>" alt="Avatar">
                </div>
                <h2 class="mb-4">Welcome, <?= $user['username'] ?? null ?>!</h2>
                <h3>Let's get started!</h3>
            </div>
        </div>
    </div>
</main>

<?php
renderFooter();
?>


