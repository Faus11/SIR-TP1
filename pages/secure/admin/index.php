<?php
require_once __DIR__ . '/../../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '/../../../templates/header.php';

$users = getAll();
$title = ' - Admin management';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- Add your CSS styles here or link to an external stylesheet -->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            font-family: Arial, sans-serif;
            background: url('/SIR-TP1/pages/assets/back.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        main {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        section {
            margin-bottom: 20px;
        }

        .btn-secondary,
        .btn-success {
            margin-bottom: 10px;
        }

        form {
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(30px);
            background: transparent;
        }

        .table-responsive {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #f8f9fa;
        }

        .modal-dialog {
            max-width: 400px;
        }

        .modal-title {
            font-size: 1.5rem;
        }

        .btn-yellow {
        background-color: #e3c624;
        color: #fff;
        cursor: pointer;
        width: 100%;
        height: 45px;
        border: none;
        outline: none;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        font-size: 14px;
        font-weight: 500;
        }
        
    </style>
</head>

<body>
        <main style="padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); backdrop-filter: blur(30px); background: transparent;">
            <section class="py-4">
                <div class="d-flex justify-content-between">
                    <a href="/SIR-TP1/pages/secure/"><button class="btn btn-secondary px-5 me-2">Back</button></a>
                    <a href="./user.php"><button class="btn-yellow px-4 ms-auto">Create user</button></a>
                </div>
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
            <section>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">FirstName</th>
                                <th scope="col">Lastname</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Administrator</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $user) {
                                ?>
                                <tr>
                                    <th scope="row"><?= $user['firstname'] ?></th>
                                    <td><?= $user['lastname'] ?></td>
                                    <td><?= $user['phoneNumber'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['admin'] == '1' ? 'Yes' : 'No' ?></td>
                                    <td>
                                        <div class="d-flex justify-content">
                                            <a href="/SIR-TP1/pages/secure/admin/update_user.php?<?= 'user=update&id=' . $user['id'] ?>"><button type="button"
                                                    class="btn btn-primary me-2">update</button></a>
                                                    <form method="POST" action="delete_user.php">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta conta?')">Delete </button>
</form>
                                            </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="delete<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete user</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this user?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="/SIR-TP1/controllers/admin/user.php?<?= 'user=delete&id=' . $user['id'] ?>"><button type="button"
                                                        class="btn btn-danger">Confirm</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    <?php
    ?>
</body>

</html>
