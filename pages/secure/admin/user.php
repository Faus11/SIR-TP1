<?php
require_once __DIR__ . '/../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '/../../../templates/header.php'; 

$title = ' - user';
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
    <form enctype="multipart/form-data" action="/SIR-TP1/controllers/admin/user.php" method="post"
      class="form-control py-3">
      <div class="input-group mb-3">
        <span class="input-group-text">FirstName</span>
        <input type="text" class="form-control" name="firstname" maxlength="100" size="100"
          value="<?= isset($_REQUEST['firstname']) ? $_REQUEST['firstname'] : null ?>" required>
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text">Last Name</span>
        <input type="text" class="form-control" name="lastname" maxlength="100" size="100"
          value="<?= isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : null ?>" required>
      </div>
       
      <div class="form-floating mb-2">
      <input type="text" class="form-control" name="username" placeholder="username" maxlength="100" size="100"
        value="<?= isset($_REQUEST['username']) ? $_REQUEST['username'] : null ?>" required>
      <label for="username">Username</label>
    </div>

      <div class="input-group mb-3">
        <span class="input-group-text">Phone Number</span>
        <input type="tel" class="form-control" name="phoneNumber" maxlength="9"
          value="<?= isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : null ?>" required>
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text">E-mail</span>
        <input type="email" class="form-control" name="email" maxlength="255"
          value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : null ?>" required>
      </div>
      
      <div class="form-floating mb-2">
      <input type="date" class="form-control" name="birthdate" placeholder="birthdate" maxlength="100" size="100"
        value="<?= isset($_REQUEST['birthdate']) ? $_REQUEST['birthdate'] : null ?>" required>
      <label for="birthdate">Birth Date</label>
    </div>

    <div class="form-outline mb-3">
  <label class="mb-2" for="pass">Password</label>
  <input type="password" class="form-control" id="pass" name="pass" placeholder="pass">
 </div>
      <!-- Password input -->
        <div class="form-outline mb-3">
     <label class="mb-2" for="confirm_password">Confirm Password</label>
           <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
             </div>

      <div class="input-group mb-3">
        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="admin" role="switch" id="flexSwitchCheckChecked"
            <?= isset($_REQUEST['admin']) && $_REQUEST['admin'] == true ? 'checked' : null ?>>
          <label class="form-check-label" for="flexSwitchCheckChecked">admin</label>
        </div>
      </div>
      <div class="d-grid col-4 mx-auto">
        <input type="hidden" name="id" value="<?= isset($_REQUEST['id']) ? $_REQUEST['id'] : null ?>">
      
        <button type="submit" class="btn btn-success" name="user" <?= isset($_REQUEST['action']) && $_REQUEST['action'] == 'update' ? 'value="update"' : 'value="create"' ?>>Create</button>
      </div>
    </form>
  </section>
</main>
<?php
require_once __DIR__ . '/../../../templates/footer.php';
?>