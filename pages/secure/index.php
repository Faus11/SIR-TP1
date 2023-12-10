<?php

// index.php

require_once 'functions.php';

$user = user();
$title = '- App';

renderHeader($title);
renderNavbar($user);
?>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="rounded-box text-center mx-auto">
                <h2 class="mb-4">Hello, <?= $user['username'] ?? null ?>!</h2>
                <a href="#" class="btn btn-stream btn-lg px-4 mx-2">Start</a>
            </div>
        </div>
    </div>
</main>

<?php
renderFooter();
?>
