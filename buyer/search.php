<?php
session_start();
require '../includes/db.php';
if ($_SESSION['role'] !== 'buyer') {
    header("Location: ../login.php");
    exit();
}

$query = "";
if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    $query = trim($_GET['q']);
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? AND status='available' ORDER BY created_at DESC");
    $likeQuery = "%$query%";
    $stmt->bind_param("s", $likeQuery);
    $stmt->execute();
    $produk = $stmt->get_result();
} else {
    $produk = $conn->query("SELECT * FROM products WHERE status='available' ORDER BY created_at DESC");
}
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
                <form class="d-flex me-3" role="search" action="search.php" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search" value="<?= htmlspecialchars($query) ?>" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-5 mt-5">
        <h4 class="section-title ms-2 mb-5"><?= $query ? "Hasil pencarian untuk '$query'" : "Semua Produk Tersedia" ?></h4>
        <div class="row">
            <?php if ($produk->num_rows > 0): ?>
                <?php while ($row = $produk->fetch_assoc()): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <a href="product_detail.php?id=<?= $row['id'] ?>" class="text-decoration-none text-dark">
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
            <?php else: ?>
                <p class="text-center">Tidak ditemukan produk dengan nama <strong><?= htmlspecialchars($query) ?></strong>.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
