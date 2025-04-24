<?php
require 'includes/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $pass, $role);
    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Gagal mendaftar.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
<div>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="p-4  rounded" style="width: 100%; max-width: 70%; background-color: white;">
            <h3 class="text-center mb-4">Register</h3>
            <form method="post" action="">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="mb-3">
                    <select class="form-select" name="role">
                        <option value="buyer">Buyer</option>
                        <option value="seller">Seller</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <p class="mt-3 text-center">Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>