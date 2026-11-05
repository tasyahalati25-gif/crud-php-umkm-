<?php
// Form dipakai bersama oleh create.php dan edit.php
$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
$v = fn($k) => e($old[$k] ?? $p[$k] ?? '');
$kategori = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();
?>
<?php if ($errors): ?>
  <div class="err"><ul><?php foreach ($errors as $er): ?><li><?= e($er) ?></li><?php endforeach; ?></ul></div>
<?php endif; ?>
<form action="<?= $action ?>" method="POST">
  <?php if (!empty($p['id'])): ?><input type="hidden" name="id" value="<?= (int)$p['id'] ?>"><?php endif; ?>
  <label>Nama Produk</label>
  <input type="text" name="name" value="<?= $v('name') ?>" required>
  <label>Harga</label>
  <input type="number" name="price" min="0" step="0.01" value="<?= $v('price') ?>" required>
  <label>Kategori</label>
  <select name="category_id" required>
    <option value="">-- pilih kategori --</option>
    <?php foreach ($kategori as $k): ?>
      <option value="<?= (int)$k['id'] ?>" <?= $v('category_id') == $k['id'] ? 'selected' : '' ?>><?= e($k['name']) ?></option>
    <?php endforeach; ?>
  </select>
  <p><button type="submit"><?= $tombol ?></button> <a href="list.php">Batal</a></p>
</form>
