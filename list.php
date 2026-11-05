<?php
// TAHAP 4: READ
require "../helpers.php";
$produk = $pdo->query(
  "SELECT p.*, c.name AS kategori FROM products p
   LEFT JOIN categories c ON c.id = p.category_id
   ORDER BY p.created_at DESC, p.id DESC")->fetchAll();
include "../header.php";
?>
<h2>Daftar Produk</h2>
<a class="btn" href="create.php">+ Tambah Produk</a>
<?php if (!$produk): ?>
  <p>Belum ada produk. Klik "Tambah Produk" untuk memulai.</p>
<?php else: ?>
<table>
  <tr><th>Nama</th><th>Kategori</th><th>Harga</th><th>Aksi</th></tr>
  <?php foreach ($produk as $p): ?>
  <tr>
    <td><?= e($p['name']) ?></td>
    <td><?= e($p['kategori']) ?></td>
    <td>Rp <?= number_format($p['price'], 0, ',', '.') ?></td>
    <td>
      <a class="btn" href="edit.php?id=<?= (int)$p['id'] ?>">Ubah</a>
      <form class="inline" action="delete.php" method="POST" onsubmit="return confirm('Hapus produk ini?')">
        <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
        <button class="btn-hapus" type="submit">Hapus</button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
<?php endif; include "../footer.php"; ?>
