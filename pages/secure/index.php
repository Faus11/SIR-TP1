<?php
require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user();
$title = '- App';

renderHeader($title);
renderNavbar($user);
?>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-14">
            <div class="rounded-box text-center mx-auto">
                <h2 class="mb-4">Welcome, <?= $user['username'] ?? null ?>!</h2>
                <h3>Let's get started!</h3>
            </div>
        </div>
    </div>

    <?php
    if ($user) {
        $contents = getContentByUserId($user['id']);

        if ($contents) {
            foreach ($contents as $content) {
                echo '<div class="content">
                        <h3><b>' . $content['title'] . '</b></h3>
                        <p>' . $content['description'] . '</p>
                    </div>';
            }
        } else {
            echo '<p class="no-content">No content available for this user.</p>';
        }
    } else {
        echo '<p class="not-logged-in">User not logged in.</p>';
    }
    ?>
</main>

<?php
renderFooter();
?>
