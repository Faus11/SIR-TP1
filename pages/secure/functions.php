<?php

// functions.php

require_once __DIR__ . '../../../infra/middlewares/middleware-user.php';
@require_once __DIR__ . '/../../helpers/session.php';


function renderHeader($title) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-..." crossorigin="anonymous"></script>

        <link rel="stylesheet" type="text/css" href="../../pages/secure/style.css">
    </head>
    <body>
    <?php
}

function renderNavbar($user) {
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
                <a href="javascript:history.go(-1)">
            <img id="logo" src="../../pages/assets/image.png" alt="MovieBreak Logo">
        </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="../../pages/secure/content.php" class="btn btn-outline-light btn-lg px-4 mx-2">Create Content</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../pages/secure/categories.php" class="btn btn-outline-light btn-lg px-4 mx-2">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../pages/secure/schedule.php" class="btn btn-outline-light btn-lg px-4 mx-2">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../pages/secure/search.php" class="btn btn-outline-light btn-lg px-4 mx-2">Search</a>
                    </li>
                   
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if (isAuthenticated()) { ?>
                        <?php if ($user['admin']) { ?>
                            <li class="nav-item">
                                <a href="../../pages/secure/admin/" class="btn btn-outline-light btn-lg px-4 mx-2">Admin</a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <li class="nav-item">
                        <a href="../../pages/secure/user/profile.php" class="btn btn-outline-light btn-lg px-4 mx-2">Change</a>
                    </li>
                    <li class="nav-item">
                        <form action="../../controllers/auth/signin.php" method="post" class="nav-link">
                            <button class="btn btn-danger btn-lg px-4 btn-logout" type="submit" name="user" value="logout">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var navbarToggler = document.querySelector('.navbar-toggler');
        navbarToggler.addEventListener('click', function () {
            var navbarNav = document.querySelector('.navbar-nav');
            navbarNav.classList.toggle('show');
        });
    });
</script>
    <?php
}

function renderFooter() {
    ?>
    </body>
    </html>
    <?php
}

?>
