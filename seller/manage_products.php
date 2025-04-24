<?php
session_start();
require '../includes/db.php';
if ($_SESSION['role'] !== 'seller') {
    header("Location: ../login.php");
    exit();
}

$seller_id = $_SESSION['id'];

// Proses update
if (isset($_POST['update_id'])) {
    $id = $_POST['update_id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];

    if ($_FILES['image']['error'] == 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image_name);
        $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, image=? WHERE id=? AND seller_id=?");
        $stmt->bind_param("ssdssi", $name, $desc, $price, $image_name, $id, $seller_id);
    } else {
        $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=? WHERE id=? AND seller_id=?");
        $stmt->bind_param("ssdii", $name, $desc, $price, $id, $seller_id);
    }
    $stmt->execute();
    header("Location: dashboard.php");
    exit();
}

// Tambah produk
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['update_id'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $image_name = null;

    if ($_FILES['image']['error'] == 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image_name);
    }

    $stmt = $conn->prepare("INSERT INTO products (seller_id, name, description, price, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issds", $seller_id, $name, $desc, $price, $image_name);
    $stmt->execute();
    header("Location: dashboard.php");
    exit();
}

// Untuk form edit
$edit_product = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id=? AND seller_id=?");
    $stmt->bind_param("ii", $id, $seller_id);
    $stmt->execute();
    $edit_product = $stmt->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $edit_product ? "Edit Produk" : "Tambah Produk" ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFE3E8;
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
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="p-4 rounded" style="width: 100%; max-width: 70%; background-color: white;">
            <h3 class="text-center mb-4"><?= $edit_product ? "Edit Product" : "Add Product" ?></h3>
            <form method="POST" enctype="multipart/form-data">
                <?php if ($edit_product): ?>
                    <input type="hidden" name="update_id" value="<?= $edit_product['id'] ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required value="<?= $edit_product['name'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"><?= $edit_product['description'] ?? '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" required value="<?= $edit_product['price'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>
                <button type="submit" style="margin-top: 30px;" class="btn btn-primary w-100">
                    <?= $edit_product ? "Save Changes" : "Add Product" ?>
                </button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
