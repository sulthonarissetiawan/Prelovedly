<?php
session_start();
require '../includes/db.php';
if ($_SESSION['role'] !== 'buyer') {
    header("Location: ../login.php");
    exit();
}
$produk = $conn->query("SELECT * FROM products WHERE status='available' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prelovedly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-lg-flex col-lg-3 justify-content-lg-end me-5">
                <button class="btn btn-outline-primary me-4" onclick="window.location.href='search.php'">
                    <i class="bi bi-search"></i>
                </button>
                <button class="btn btn-primary me-2 ms-1" onclick="window.location.href='../logout.php'">Logout</button>
                <button class="btn btn-outline-primary" onclick="window.location.href='#'">Profile</button>
            </div>
        </div>
    </nav>
    <div class="bd-example-snippet bd-code-snippet">
        <div class="bd-example m-0 border-0 ms-5 me-5 mt-5 mb-5">
            <p class="h1 ms-2" style="margin-bottom: 15px;">Welcome, Shop now!</p>
            <p class="lead ms-2" style="margin-bottom: 20px;">Easy, fast and safe</p>
        </div>
    </div>
    <div class="bd-example-snippet bd-code-snippet">
        <div class="bd-example m-0 border-0 ms-5 me-5 mt-5 mb-5">
            <img src="../assets/product.jpg" class="img-fluid me-2 ms-2" alt="Banner" style="height: 750px; width: 99%; object-fit: cover;">
        </div>
    </div>
    <div class="container-fluid px-5 mt-5">
        <h4 class="section-title ms-2 mb-5">Products recommendation</h4>
        <div class="row">
            <?php while ($row = $produk->fetch_assoc()): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="#" class="text-decoration-none text-dark">
                        <div class="card project-card h-100">
                            <?php if ($row['image']): ?>
                                <img src="../uploads/<?= $row['image'] ?>" class="card-img-top">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                                <p class="card-text">Rp<?= number_format($row['price']) ?><br></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>