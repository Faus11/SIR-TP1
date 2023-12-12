<?php
require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
require_once __DIR__ . '../../../templates/header.php';

$title = ' - Content';
?>

<main>
  <section class="py-4">
    <a href="./"><button type="button" class="btn btn-secondary px-5">Back</button></a>
  </section>
  <section>
    <?php
    if (isset($_SESSION['success'])) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
      echo $_SESSION['success'] . '<br>';
      echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
      unset($_SESSION['success']);
    }
    if (isset($_SESSION['errors'])) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
      foreach ($_SESSION['errors'] as $error) {
        echo $error . '<br>';
      }
      echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
      unset($_SESSION['errors']);
    }
    ?>
  </section>
  <section class="pb-4">
  <form enctype="multipart/form-data" action="/SIR-TP1/controllers/content/content.php" method="post" class="form-control py-3">
    <div class="input-group mb-3">
        <span class="input-group-text">Title</span>
        <input type="text" class="form-control" name="title" maxlength="255" value="<?= isset($_REQUEST['title']) ? $_REQUEST['title'] : '' ?>" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Image</span>
        <input type="file" class="form-control" name="image" accept="image/*">
    </div>

    <div class="input-group mb-3">
    <span class="input-group-text">Restricted</span>
    <input type="text" class="form-control" name="restricted" maxlength="3" required
        value="<?= isset($_REQUEST['restricted']) ? $_REQUEST['restricted'] : null ?>">
</div>



    <div class="input-group mb-3">
        <span class="input-group-text">Seasons</span>
        <input type="number" class="form-control" name="seasons" min="1" value="<?= isset($_REQUEST['seasons']) ? $_REQUEST['seasons'] : '' ?>">
    </div>

    <div class="form-floating mb-2">
        <textarea class="form-control" name="description" placeholder="Description" style="height: 100px;"><?= isset($_REQUEST['description']) ? $_REQUEST['description'] : '' ?></textarea>
        <label for="description">Description</label>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Cast</span>
        <input type="text" class="form-control" name="cast" value="<?= isset($_REQUEST['cast']) ? $_REQUEST['cast'] : '' ?>">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Release Date</span>
        <input type="date" class="form-control" name="release_date" value="<?= isset($_REQUEST['release_date']) ? $_REQUEST['release_date'] : '' ?>">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">End Date</span>
        <input type="date" class="form-control" name="end_date" value="<?= isset($_REQUEST['end_date']) ? $_REQUEST['end_date'] : '' ?>">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Category ID</span>
        <input type="number" class="form-control" name="category_id" min="1" value="<?= isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : '' ?>">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Format ID</span>
        <input type="number" class="form-control" name="format_id" min="1" value="<?= isset($_REQUEST['format_id']) ? $_REQUEST['format_id'] : '' ?>">
    </div>

    <div class="d-grid col-4 mx-auto">
        <button type="submit" class="btn btn-success" name="content" value="create">Create Content</button>
    </div>
</form>

  </section>
</main>

<?php
require_once __DIR__ . '../../../templates/footer.php';
?>