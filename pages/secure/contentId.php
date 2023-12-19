<?php
require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';
require_once __DIR__ . '/../../infra/repositories/reviewRepository.php';

$user = user();
$userId = $user['id']; 
$title = 'Content Details';
renderHeader($title);
renderNavbar($user);
?>

<style>
    .comment-container {
        position: relative;
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }

    .comment-buttons {
        position: absolute;
        top: 5px;
        right: 5px;
    }

    .comment-buttons form {
        display: inline;
        margin-right: 5px;
    }
</style>

<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div style="text-align: left;"> 
        <?php
        $contentId = $_GET['id'] ?? null;

        if (!is_numeric($contentId)) {
            ?>
            <h3>Invalid content ID.</h3>
            <?php
        } else {
            $contentInfo = getInfoByIdContent($contentId);
            ?>
            <h2 style="font-size: 35px;"><strong><?= $contentInfo['title'] ?></strong></h2>
            <p style="font-size: 25px;"><strong>Release Date:</strong> <?= $contentInfo['release_date'] ?></p>
            <p style="font-size: 25px;"><strong>Description:</strong> <?= $contentInfo['description'] ?></p>
            <p style="font-size: 25px;"><strong>Cast:</strong> <?= $contentInfo['cast'] ?></p>
            <p style="font-size: 25px;"><strong>Attachments:</strong> <?= $contentInfo['trailer'] ?></p>
            <p style="font-size: 25px;"><strong>Seasons:</strong> <?= $contentInfo['seasons'] ?></p>

            <form enctype="multipart/form-data" action="/SIR-TP1/controllers/content/content.php" method="post">
                <label for="end_date">Calendariar Filme:</label>
                <input type="date" id="end_date" name="end_date">
                <input type="hidden" name="id" value="<?= $contentId ?>">
                <input type="submit" name="content" value="add_date">
            </form>
            <?php
        }
        ?>

        <form enctype="multipart/form-data" action="/SIR-TP1/controllers/sharee/share.php" method="post" style="margin-top: 10px;">
            <input type="hidden" name="content_id" value="<?= $contentId ?>">
            <input type="hidden" name="sharer_user_id" value="<?= $userId ?>">
            <label for="receiver_email">Partilhar com o Utilizador (Email):</label>
            <input type="email" name="receiver_email" id="receiver_email" required>
            <button type="submit" name="share" value="create" class="btn btn-primary">Share</button>
        </form>
    </div>
</div>

<hr>

<?php
$reviews = getReviewsByUserAndContent($userId, $contentId);

if (count($reviews) > 0) {
    ?>
    <h3>Comentários:</h3>
    <?php
    foreach ($reviews as $review) {
        ?>
        <div class="comment-container">
            <div class="comment-content">
                <p>Comentário: <?= $review['comment'] ?></p>
                <p>Rating: <?= $review['rating'] ?></p>
            </div>

            <div class="comment-buttons">
                <form enctype="multipart/form-data" action="/SIR-TP1/controllers/review/review.php" method="post">
                    <input type="hidden" name="id_review" value="<?= $review['id_review'] ?>">
                    <button type="submit" class="btn btn-info" name="review" value="edit">Edit</button>
                </form>

                <form enctype="multipart/form-data" action="/SIR-TP1/controllers/review/review.php" method="post">
                    <input type="hidden" name="id_review" value="<?= $review['id_review'] ?>">
                    <button type="submit" class="btn btn-danger" name="review" value="delete">Delete</button>
                </form>
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <p>Não há comentários para este conteúdo.</p>
    <?php
}
?>

<form enctype="multipart/form-data" action="/SIR-TP1/controllers/review/review.php" method="post" class="form-control py-3">
    <h3>Adicionar Comentário:</h3>

    <div class="input-group mb-3">
        <span class="input-group-text">Comentário</span>
        <textarea class="form-control" name="comment" rows="4" placeholder="Escreva seu comentário aqui" required><?= isset($_REQUEST['comment']) ? $_REQUEST['comment'] : '' ?></textarea>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Rating</span>
        <input type="number" class="form-control" name="rating" min="1" max="5" required value="<?= isset($_REQUEST['rating']) ? $_REQUEST['rating'] : '' ?>">
    </div>

    <input type="hidden" name="content_id" value="<?= $contentId ?>">
    <input type="hidden" name="user_id" value="<?= $userId ?>">
    <input type="submit" name="review" value="create">
</form>


</div>
</div>






