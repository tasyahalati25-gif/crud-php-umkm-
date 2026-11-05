<?php
// TAHAP 6: UPDATE (proses)
require "../helpers.php";
require "_validasi.php";
harus_post();

$id    = (int)($_POST['id'] ?? 0);
$name  = trim($_POST['name'] ?? '');
$price = $_POST['price'] ?? '';
$cat   = $_POST['category_id'] ?? '';

$errors = validasi_produk($pdo, $name, $price, $cat);
if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    redirect("edit.php?id=$id");
}

$stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, category_id = ? WHERE id = ?");
$stmt->execute([$name, $price, $cat, $id]);

flash('ok', 'Produk berhasil diperbarui');
redirect("list.php");
