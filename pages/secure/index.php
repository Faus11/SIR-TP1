<?php
require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '/../../helpers/session.php';



$user = user();
$title = '- App';
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<main>

    

<div class="btn-group">
    <form action="../../controllers/auth/signin.php" method="post">
        <button class="btn btn-danger btn-lg px-4" type="submit" name="user" value="logout">Logout</button>
    </form>
    <a href="/SIR-TP1/pages/secure/user/profile.php" class="btn btn-outline-light btn-lg px-5 mx-2">Change</a>
</div>



  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="h-100 p-5 text-bg-dark rounded-3">
          <h2>Hello <?= $user['username'] ?? null ?>!</h2>

          <p class="col-md-8 fs-4">Ready for today?</p>
        </div> <?php
            if (isAuthenticated() && $user['admin']) {
                echo '<li><a class="dropdown-item" href="/SIR-TP1/pages/secure/admin/">Admin</a></li>';
            }
            ?>
      </div>
    </div>
  </div>
</main>

<?php


?>