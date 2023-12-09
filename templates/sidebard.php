<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome-free-6.2.1-web/css/all.css">
    <link rel="stylesheet" href="./style.css">
    <title>Side Menu</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="bg-dark col-auto col-md-3 col-lg-4 min-vh-100 d-flex flex-column justify-content-between">
                <div class="bg-dark p-2">
                    <a class="d-flex text-decoration-none mt-1 align-items-center text-white">
                        <span class="fs-4 d-none d-sm-inline">SideMenu</span>
                    </a>
                    <ul class="nav nav-pills flex-column mt-4">
                        <li class="nav-item py-2 py-sm-0">
                            <a href="#" class="nav-link text-white">
                                <i class="fs-5 fa fa-gauge"></i><span
                                    class="fs-4 ms-3 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-0">
                            <a href="#" class="nav-link text-white">
                                <i class="fs-5 fa fa-house"></i><span class="fs-4 ms-3 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-0">
                            <a href="#" class="nav-link text-white">
                                <i class="fs-5 fa fa-table-list"></i><span
                                    class="fs-4 ms-3 d-none d-sm-inline">Articles</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-0">
                            <a href="#" class="nav-link text-white">
                                <i class="fs-5 fa fa-table-list"></i><span
                                    class="fs-4 ms-3 d-none d-sm-inline">Products</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-0">
                            <a href="#" class="nav-link text-white">
                                <i class="fs-5 fa fa-clipboard"></i><span
                                    class="fs-4 ms-3 d-none d-sm-inline">Orders</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-0">
                            <a href="#" class="nav-link text-white">
                                <i class="fs-5 fa fa-users"></i><span
                                    class="fs-4 ms-3 d-none d-sm-inline">Costumers</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown open p-3">
                    <button class="btn border-none dropdown-toggle text-white" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i><span class="ms-2">User</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <button class="dropdown-item" href="#">Setting></button>
                        <button class="dropdown-item disabled" href="#">Profile</button>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <h2> Content Area </h2>
            </div>

        </div>
    </div>

    <script scr="./Bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>

