<?php
require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '/../../helpers/session.php';
include_once __DIR__ . '../../../templates/header.php';

$user = user();
$title = '- App';
?>

<main>
  <header class="pb-3 mb-4 border-bottom d-flex justify-content-end">
    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
      <img src="/assets/images/logo-estg.svg" alt="ESTG" class="mw-100">
    </a>

    <div class="btn-group">
    <form action="../../controllers/auth/signin.php" method="post">
                    <button class="btn btn-danger btn-lg px-4" type="submit" name="user" value="logout">Logout</button>
                </form>
      <button type="button" class="btn btn-outline-light btn-lg px-5" data-bs-toggle="dropdown">
        Profile
      </button>
      <ul class="dropdown-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="/SIR-TP1/pages/secure/user/profile.php">Change</a></li>
        <?php
        if (isAuthenticated() && $user['admin']) {
          echo '<li><a class="dropdown-item" href="/SIR-TP1/pages/secure/admin/">Admin</a></li>';
        }
        ?>
      </ul>
    </div>
  </header>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="h-100 p-5 text-bg-dark rounded-3">
          <h2>Hello <?= $user['username'] ?? null ?>!</h2>

          <p class="col-md-8 fs-4">Ready for today?</p>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
include_once __DIR__ . '../../../templates/footer.php';
?>