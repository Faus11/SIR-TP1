<?php
require_once __DIR__ . '/../../infra/middlewares/middleware-not-authenticated.php';
$title = '- Sign Up';
include_once __DIR__ . '../../../templates/header.php'; ?>

<main>
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
  <form action="/SIR-TP1/controllers/auth/signup.php" method="post">
    <h1 class="h3 mb-3 fw-normal">Sign Up</h1>
      
    <div class="form-floating mb-2">
      <input type="text" class="form-control" name="firstname" placeholder="firstname" maxlength="100" size="100"
        value="<?= isset($_REQUEST['firstname']) ? $_REQUEST['firstname'] : null ?>" required>
      <label for="firstname">First Name</label>
    </div>

    <div class="form-floating mb-2">
      <input type="text" class="form-control" name="lastname" placeholder="lastname" maxlength="100" size="100"
        value="<?= isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : null ?>" required>
      <label for="lastname">Last Name</label>
    </div>

    <div class="form-floating mb-2">
      <input type="text" class="form-control" name="username" placeholder="username" maxlength="100" size="100"
        value="<?= isset($_REQUEST['username']) ? $_REQUEST['username'] : null ?>" required>
      <label for="username">Username</label>
    </div>

    <div class="form-floating mb-2">
      <input type="tel" class="form-control" name="phoneNumber" placeholder="phoneNumber" maxlength="100" size="100"
        value="<?= isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : null ?>" required>
      <label for="phoneNumber">Phone Number</label>
    </div>

    <div class="form-floating mb-2">
      <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com"
        value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : null ?>">
      <label for="floatingInput">Email</label>
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
    
    <button class="w-100 btn btn-lg btn-success mb-2" type="submit" name="user" value="signUp">Sign Up</button>
  </form>
  <a href="/SIR-TP1/"><button class="w-100 btn btn-lg btn-info">Back</button></a>
</main>
<?php
include_once __DIR__ . '../../../templates/footer.php'; ?>
?>