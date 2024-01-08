<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Details</title>
  
  


    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            color: white;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(180deg, #4b6cb7 0%, #182848 100%);
            margin: 0;
        }

        .card-container {
            background-color: rgba(0, 0, 0, 0.12);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(30px);
            background: transparent;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 15px;
            width: 70%;
            margin-top: 260px;
            border-radius: 15px;
        }

        .card-header {
            text-align: center;
            margin-bottom: 15px;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .content-details {
            font-size: 18px;
        }

        .comments-section {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 15px;
        }

        .comments-section h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .comment-container {
            margin-top: 15px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 10px;
        }

        .comment-content {
            font-size: 18px;
        }

        .comment-buttons {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }

        .comment-buttons form {
            display: flex;
            flex-direction: column;
        }

        #end_date {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 8px;
            border: none;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        input[type="submit"][name="content"],
        input[type="submit"][name="review"],
        .btn-info,
        .btn-danger {
            background-color: #ffd700;
            color: #000;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .comment-form {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 15px;
        }

        .comment-form h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .comment-form textarea {
            width: 100%;
            padding: 10px;
            
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .comment-form input[type="number"] {
            width: 100px;
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .comment-form input[type="submit"] {
            width: 150px;
        }
        .rating {
        unicode-bidi: bidi-override;
        direction: ltr;
    }

    .star {
        cursor: pointer;
        display: inline-block;
        font-size: 30px;
    }

    .star:hover:before,
    .star.filled:before {
        content: '★';
        color: gold;
    }

    .star:before {
        content: '☆';
    }

    input[type="hidden"] {
    display: none;
    }
    </style>
</head>
<body>

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

<div class="card-container">

    <?php
    $contentId = $_GET['id'] ?? null;
    if (!is_numeric($contentId)) {
        echo '<h3>Invalid content ID.</h3>';
    } else {
        $contentInfo = getInfoByIdContent($contentId);
        ?>

        <div class="card-header">
            <h2 style="font-size: 30px;"><strong><?= $contentInfo['title'] ?></strong></h2>
        </div>

        <div class="card-content">
            <p class="content-details"><strong>Release Date:</strong> <?= $contentInfo['release_date'] ?></p>
            <p class="content-details"><strong>Description:</strong> <?= $contentInfo['description'] ?></p>
            <p class="content-details"><strong>Cast:</strong> <?= $contentInfo['cast'] ?></p>
            <p class="content-details"><strong>Attachments:</strong><a href="<?= $contentInfo['trailer'] ?>" target="_blank"><?= $contentInfo['trailer'] ?></a></p>

            <p class="content-details"><strong>Seasons:</strong> <?= $contentInfo['seasons'] ?></p>
          

            <form enctype="multipart/form-data" action="/SIR-TP1/controllers/content/content.php" method="post">
                <label for="end_date">Calendarize Content:</label>
                <input type="date" id="end_date" name="end_date">
                <input type="hidden" name="id" value="<?= $contentId ?>">
                <button type="submit" name="content" value="add_date" class="btn btn-warning">Calendarize</button>
                <?php if (!empty($contentInfo['end_date'])) : ?>
            <button type="submit" name="content" value="delete_date" class="btn btn-danger">Delete</button>
        <?php endif; ?>
    </form>


            <!-- Partilhar com o utilizador -->
            <form enctype="multipart/form-data" action="/SIR-TP1/controllers/sharee/share.php" method="post" style="margin-top: 10px;">
                <input type="hidden" name="content_id" value="<?= $contentId ?>">
                <input type="hidden" name="sharer_user_id" value="<?= $userId ?>">
                <label for="receiver_email">Partilhar com o Utilizador (Email):</label>
                <input type="email" name="receiver_email" id="receiver_email" required>
                <button type="submit" name="share" value="create" class="btn btn-warning">Share</button>
            </form>
        </div>

        <?php
    }
    ?>

    <?php
    $reviews = getReviewsByUserAndContent($userId, $contentId);

    if (count($reviews) > 0) {
        ?>

        <div class="comments-section">
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
                        <form enctype="multipart/form-data" action="/SIR-TP1/controllers/review/review.php"
                              method="post">
                            <input type="hidden" name="id_review" value="<?= $review['id_review'] ?>">
                        </form>

                        <form enctype="multipart/form-data" action="/SIR-TP1/controllers/review/review.php"
                              method="post">
                            <input type="hidden" name="id_review" value="<?= $review['id_review'] ?>">
                            <button type="submit" class="btn btn-danger" name="review" value="delete">Delete</button>
                        </form>
                    </div>
                </div>

                <?php
            }
            ?>

        </div>

        <?php
    } else {
        echo '<p>Não há comentários para este conteúdo.</p>';
    }
    ?>

    <form enctype="multipart/form-data" action="/SIR-TP1/controllers/review/review.php" method="post"
          class="comment-form">
        <h3>Adicionar Comentário:</h3>

        <div class="input-group mb-3">
            <span class="input-group-text">Comentário</span>
            <textarea class="form-control" name="comment" rows="4"
                      placeholder="Escreva seu comentário aqui" required><?= isset($_REQUEST['comment']) ? $_REQUEST['comment'] : '' ?></textarea>
        </div>

        <div class="rating" style="display: flex; align-items: center;">
        <p style="margin-right: 10px; margin-bottom: 10;">Rating:</p>
        <div style="display: flex; align-items: center; margin-top: -15px;">
            <span class="star" data-value="1"></span>
            <span class="star" data-value="2"></span>
            <span class="star" data-value="3"></span>
            <span class="star" data-value="4"></span>
            <span class="star" data-value="5"></span>
        </div>
        <input type="hidden" name="rating" class="form-control" value="<?= isset($_REQUEST['rating']) ? $_REQUEST['rating'] : '0' ?>">
    </div>


        <input type="hidden" name="content_id" value="<?= $contentId ?>">
        <input type="hidden" name="user_id" value="<?= $userId ?>">
        <button type="submit" name="review" value="create"class="btn btn-warning">Add Comment</button>
    </form>

</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.querySelector('input[name="rating"]');
    
    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const value = this.getAttribute('data-value');
            ratingInput.value = value;

            // Remover estrelas preenchidas
            stars.forEach(s => {
                s.classList.remove('filled');
            });

            // Preencher estrelas até a clicada
            this.classList.add('filled');
            let prev = this.previousElementSibling;
            while (prev !== null) {
                prev.classList.add('filled');
                prev = prev.previousElementSibling;
            }
        });
    });
});
</script>
</body>
</html>
