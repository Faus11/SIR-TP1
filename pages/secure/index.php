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
                <h3> Let's get started!</h3>
            </div>
        </div>
    </div>

    <?php
if ($user) {
    $contents = getContentByUserId($user['id']);

    if ($contents) {
        echo '<div class="card" style="background-color: black; color: white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); transition: 0.3s;">';
        echo '<div class="container" style="padding: 2px 16px;">';
        echo '<h4><b>User Content</b></h4>';

        foreach ($contents as $content) {
            echo '<div class="col-md-4">';
            echo '<div class="card mb-3" style="background-color: black; color: white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); transition: 0.3s;">';
            
            echo '<div class="container" style="padding: 2px 16px;">';
            echo '<h4><b>' . $content['title'] . '</b></h4>';
            echo '<p>' . $content['description'] . '</p>';
         
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</div>';
    } else {
        echo '<p>No content available for this user.</p>';
    }
} else {
    echo '<p>User not logged in.</p>';
}
?>


</main>

<?php
renderFooter();
?>
