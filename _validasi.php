<?php
// TAHAP 10: validasi di sisi server (dipakai store.php & update.php)
function validasi_produk($pdo, $name, $price, $cat) {
    $errors = [];
    if ($name === '') $errors[] = "Nama wajib diisi.";
    if (!is_numeric($price) || $price < 0) $errors[] = "Harga tidak valid.";
    $cek = $pdo->prepare("SELECT id FROM categories WHERE id = ?");
    $cek->execute([$cat]);
    if (!$cek->fetch()) $errors[] = "Kategori tidak valid.";
    return $errors;
}
