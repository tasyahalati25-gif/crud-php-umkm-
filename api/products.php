<?php
require "../koneksi.php";
header("Content-Type: application/json; charset=utf-8");

function kirim($data, $kode = 200) {
    http_response_code($kode);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$id     = isset($_GET['id']) ? (int) $_GET['id'] : null;
$body   = json_decode(file_get_contents("php://input"), true);

if ($method === 'GET') {
    if ($id) {
        $s = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $s->execute([$id]);
        $p = $s->fetch();
        $p ? kirim($p) : kirim(["error" => "Produk tidak ditemukan"], 404);
    }
    $rows = $pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();
    kirim(["data" => $rows]);
}
if ($method === 'POST') {
    if ($body === null) kirim(["error" => "JSON tidak valid"], 400);

    $name  = trim($body['name'] ?? '');
    $price = $body['price'] ?? null;

    if ($name === '' || !is_numeric($price) || $price < 0)
        kirim(["error" => "Nama/harga tidak valid"], 422);

    $s = $pdo->prepare("INSERT INTO products (name, price, category_id) VALUES (?,?,?)");
    $s->execute([$name, $price, $body['category_id'] ?? 1]);
    kirim(["id" => $pdo->lastInsertId(), "name" => $name], 201);
}

kirim(["error" => "Method tidak didukung"], 405);