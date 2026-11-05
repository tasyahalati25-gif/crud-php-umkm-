<?php
// TAHAP 7: DELETE (hanya lewat POST)
require "../helpers.php";
harus_post();

$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([(int)($_POST['id'] ?? 0)]);

flash('ok', 'Produk berhasil dihapus');
redirect("list.php");
