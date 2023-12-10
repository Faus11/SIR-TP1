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
        <style>
            body {
                background: url('../../pages/assets/back.png');
                background-size: cover;
                color: #fff;
                font-family: 'Arial', sans-serif;
            }

            main {
                margin-top: 80px;
                /* Center the content */
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh; /* 100% of the viewport height */
                max-width: 800px; /* Set a fixed maximum width */
                margin-left: auto;
                margin-right: auto;
            }

            .navbar {
                box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            }

            .rounded-box {
                background-color: rgba(0, 0, 0, 0.7);
                border-radius: 10px;
                padding: 20px;
            }

            h2 {
                color: #f39c12;
            }

            .btn-stream {
                background-color: #e74c3c;
                color: #fff;
            }

            .navbar-brand img {
                height: 40px; /* Adjust the height as needed */
                margin-right: 10px; /* Add some spacing between logo and text */
            }
        </style>
    </head>
    <body>
    <?php
}

function renderNavbar($user) {
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../pages/assets/image.png" alt="MovieBreak Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form action="../../controllers/auth/signin.php" method="post" class="nav-link">
                            <button class="btn btn-danger btn-lg px-4" type="submit" name="user" value="logout">Logout</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a href="/SIR-TP1/pages/secure/user/profile.php" class="btn btn-outline-light btn-lg px-4 mx-2">Change</a>
                    </li>
                    <?php if (isAuthenticated()) { ?>
                        <?php if ($user['admin']) { ?>
                            <li class="nav-item">
                                <a href="/SIR-TP1/pages/secure/admin/" class="btn btn-outline-light btn-lg px-4 mx-2">Admin</a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
}

function renderFooter() {
    ?>
    </body>
    </html>
    <?php
}

?>
