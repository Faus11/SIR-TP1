<?php
require_once 'functions.php';
require_once __DIR__ . '/../../infra/repositories/contentRepository.php';

$user = user(); 
$title = '- Categories';
renderHeader($title);
renderNavbar($user);

$category_id = $_GET['category_id'] ?? null;
?>

<form enctype="multipart/form-data" action="../../controllers/content/content.php" method="post">

<?php
if (!is_numeric($category_id)) {
  ?>
  Invalid category ID.
  <?php
} else {
  $contentByCategory = getContentByUserIdAndCategory($user['id']);
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

    .card-transparent {
      background-color: rgba(0, 0, 0, 0.12);
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(30px);
      background: transparent;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      width: 200%; 
      min-height: 400px; 
    }

    .card-img-top {
      height: 300px;
      width: 100%;
      object-fit: cover;
    }

    .card-body {
      flex-grow: 1;
    }

    .btn-warning {
      background-color: #e3c624;
      border-color: #e3c624;
      margin-top: auto;
    }
    .custom-margin-top {
      margin-top: 370px; 
    }
</style>

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="row">

<?php
if ($contentByCategory && isset($contentByCategory[$category_id])) {
    foreach ($contentByCategory[$category_id] as $index => $content) {
        $contentId = $content['id'];
        $contentLink = "content.php?id=$contentId";
        $customMarginClass = in_array($index, [0, 1]) ? 'custom-margin-top' : '';
?>

        <div class="col-md-6 mb-5 <?= $customMarginClass ?>">
          <div class="card card-transparent" style="width: 100%;">
            <img class="card-img-top" src="data:image/webp;base64,<?= $content['image'] ?>" alt="Card image cap">
            <div class="card-body text-center">
              <h5 class="card-title text-dark"><b>Title: <?= $content['title'] ?></b></h5>
              <p class="card-text text-white">Release Date: <?= $content['release_date'] ?></p>
              <div class="d-flex justify-content-between mt-3">
                <a href="contentId.php?id=<?= $contentId ?>" class="btn btn-warning btn-block">View</a>
                <form action="../../controllers/content/content.php" method="post">
                    <input type="hidden" name="id" value="<?= $contentId ?>">
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteModal<?= $contentId ?>">Delete</button>
                </form>
                <a href="updateContent.php?id=<?= $contentId ?>" class="btn btn-info btn-block">Edit</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal de Confirmação para Delete -->
        <div class="modal fade" id="deleteModal<?= $contentId ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $contentId ?>" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"  >
              <div class="modal-header">
                <h5 class="modal-title " id="deleteModalLabel <?= $contentId ?>" style="color: black;">Confirm Delete </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"  style="color: black;">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="color: black;">

                Are you sure you want to delete this content?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <form action="../../controllers/content/content.php" method="post">
                    <input type="hidden" name="id" value="<?= $contentId ?>">
                    <button type="submit" class="btn btn-danger" name="content" value="delete">Delete</button>
                </form>
              </div>
            </div>
          </div>
        </div>

<?php
    }

    ?>
    </div>
    </div> 
    </div> 
    <?php
  } else {
    ?>
    <div class='col-md-12 text-center'>
      No content available for this category.
    </div>
    <?php
  }
}
?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

