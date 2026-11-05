<?php
// TAHAP 5: CREATE (proses simpan)
require "../helpers.php";
require "_validasi.php";
harus_post();

$name  = trim($_POST['name'] ?? '');
$price = $_POST['price'] ?? '';
$cat   = $_POST['category_id'] ?? '';

$errors = validasi_produk($pdo, $name, $price, $cat);
if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    redirect("create.php");
}

$stmt = $pdo->prepare("INSERT INTO products (name, price, category_id) VALUES (?, ?, ?)");
$stmt->execute([$name, $price, $cat]);

flash('ok', 'Produk berhasil ditambahkan');
redirect("list.php");
