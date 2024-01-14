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
        </style>
<main class="container"> 
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <div class="rounded-box text-center mx-auto">
            <img class="card-img-top" src="data:image/webp;base64,<?= $user['avatar'] ?> "alt="Card image cap">
                <h2 class="mb-4">Welcome, <?= $user['username'] ?? null ?>!</h2>
                <h3>Let's get started!</h3>
            </div>
        </div>
    </div>
</main>

<?php
renderFooter();
?>

