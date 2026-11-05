<?php
// TAHAP 6: UPDATE (form edit)
require "../helpers.php";
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch();
if (!$p) { flash('err', 'Produk tidak ditemukan'); redirect("list.php"); }
$action = "update.php"; $tombol = "Update";
include "../header.php";
echo "<h2>Ubah Produk</h2>";
include "_form.php";
include "../footer.php";
