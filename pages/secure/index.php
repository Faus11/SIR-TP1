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
            echo '<div class="row">';
            
           
            foreach ($contents as $content) {
                echo '<div class="col-md-4">';
                echo '<div class="card">';
                
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $content['title'] . '</h5>';
                echo '<p class="card-text">' . $content['description'] . '</p>';
             
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            
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
