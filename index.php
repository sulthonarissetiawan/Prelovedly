<?php
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'buyer') header('Location: buyer/dashboard.php');
    elseif ($_SESSION['role'] == 'seller') header('Location: seller/dashboard.php');
    elseif ($_SESSION['role'] == 'admin') header('Location: admin/dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prelovedly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFE3E8;
        }
        .navbar-expand {
            height: 100px;
        }
        .navbar-brand {
            color: #FFC0CB;
            pointer-events: none;
            cursor: default; 
        }
        .btn-outline-primary {
            margin-left: 20px;
            border-color: #FFC0CB;
            color: black;
            align-items: right;
        }
        .btn-primary {
            background-color: #FFC0CB;
            border-color: #FFC0CB;
            color: black;
        }
        .btn-primary:hover {
            background-color: #FF69B4;
            border-color: #FF69B4;
            color: black;
        }
        .btn-outline-primary:hover {
            background-color: #FF69B4;
            border-color: #FF69B4;
            color: black;
        }
        .img-fluid {
            border-radius: 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-body-tertiary rounded" aria-label="Second navbar example">
        <div class="container-fluid">
            <h1 class="navbar-brand mb-0 fs-3 ms-5">Prelovedly</h1>
            <div class="d-lg-flex col-lg-3 justify-content-lg-end me-5">
                <button class="btn btn-primary me-2" onclick="window.location.href='register.php'">Register</button>
                <button class="btn btn-outline-primary" onclick="window.location.href='login.php'">Login</button>
            </div>
        </div>
    </nav>
    <div class="bd-example-snippet bd-code-snippet">
        <div class="bd-example m-0 border-0 ms-5 me-5 mt-5 mb-5">
            <p class="h1 ms-2" style="margin-bottom: 15px;">Sell ​​Your Items Now!!</p>
            <p class="lead ms-2" style="margin-bottom: 20px;">Easy, fast and safe</p>
            <button class="btn btn-primary ms-2" onclick="window.location.href='register.php'">Register</button>
        </div>
    </div>
    <div class="bd-example-snippet bd-code-snippet">
        <div class="bd-example m-0 border-0 ms-5 me-5 mt-5 mb-5">
            <img src="assets/product.jpg" class="img-fluid me-2 ms-2" style="height: 750px; width: 99%; object-fit: cover;">
        </div>
    </div>
    <div class="container-fluid px-5 mt-5">
        <h4 class="section-title ms-2 mb-5">Products recommendation</h4>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card project-card h-100">
                        <img src="uploads/product.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Gaming laptop</h5>
                            <p class="card-text">Cheap and good gaming laptop</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card project-card h-100">
                        <img src="uploads/product.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Gaming laptop</h5>
                            <p class="card-text">Cheap and good gaming laptop</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card project-card h-100">
                        <img src="uploads/product.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Gaming laptop</h5>
                            <p class="card-text">Cheap and good gaming laptop</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card project-card h-100">
                        <img src="uploads/product.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Gaming laptop</h5>
                            <p class="card-text">Cheap and good gaming laptop</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card project-card h-100">
                        <img src="uploads/product.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Gaming laptop</h5>
                            <p class="card-text">Cheap and good gaming laptop</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card project-card h-100">
                        <img src="uploads/product.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Gaming laptop</h5>
                            <p class="card-text">Cheap and good gaming laptop</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card project-card h-100">
                        <img src="uploads/product.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Gaming laptop</h5>
                            <p class="card-text">Cheap and good gaming laptop</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="card project-card h-100">
                        <img src="uploads/product.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Gaming laptop</h5>
                            <p class="card-text">Cheap and good gaming laptop</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>