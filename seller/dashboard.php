<?php
session_start();
require '../includes/db.php';

if ($_SESSION['role'] !== 'seller') {
    header("Location: ../login.php");
    exit();
}

$seller_id = $_SESSION['id'];

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$id AND seller_id=$seller_id");
    header("Location: dashboard.php");
    exit();
}

$produk = $conn->query("SELECT * FROM products WHERE seller_id = $seller_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prelovedly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        }
        .btn-outline-primary {
            margin-left: 20px;
            border-color: #FFC0CB;
            color: black;
        }
        .btn-primary {
            background-color: #FFC0CB;
            border-color: #FFC0CB;
            color: black;
        }
        .btn-primary:hover, .btn-outline-primary:hover {
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
    <nav class="navbar navbar-expand navbar-dark bg-body-tertiary rounded">
        <div class="container-fluid">
            <h1 class="navbar-brand mb-0 fs-3 ms-5">Prelovedly</h1>
            <div class="d-lg-flex col-lg-3 justify-content-lg-end me-5">
                <button class="btn btn-primary me-2" onclick="window.location.href='../logout.php'">Logout</button>
                <button class="btn btn-outline-primary" onclick="window.location.href='#'">Profile</button>
            </div>
        </div>
    </nav>
    <div class="bd-example-snippet bd-code-snippet">
        <div class="bd-example m-0 border-0 ms-5 me-5 mt-5 mb-5">
            <p class="h1 ms-2" style="margin-bottom: 15px;">Welcome, Sell now!</p>
            <p class="lead ms-2" style="margin-bottom: 20px;">Easy, fast and safe</p>
            <button class="btn btn-primary mb-5" onclick="window.location.href='manage_products.php'">Add product</button>
        </div>
    </div>
    <div class="container-fluid px-5 mt-5">
        <h4 class="section-title ms-2 mb-5">Your products</h4>
        <div class="row">
            <?php while ($row = $produk->fetch_assoc()): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <?php if ($row['image']): ?>
                            <img src="../uploads/<?= $row['image'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <img src="../assets/default.jpg" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                            <p class="card-text"><strong>Rp <?= number_format($row['price'], 0, ',', '.') ?></strong></p>
                            <a href="manage_products.php?edit=<?= $row['id'] ?>" class="btn btn-primary">Edit</a>
                            <a href="dashboard.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this product?')" class="btn btn-primary ms-3">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
