<?php
session_start();
include("../db.php");
// Eliminar producto del carrito
if (isset($_GET['eliminar'])) {
$id = $_GET['eliminar'];
unset($_SESSION['carrito'][$id]);
header("Location: carrito.php");
exit;
}
$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mi carrito</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.cs
s" rel="stylesheet">
</head>
<body>
<div class="container py-5">
<h2 class="mb-4">Carrito de Compras</h2>
<?php if (!empty($_SESSION['carrito'])): ?>
<table class="table table-bordered table-hover">
<thead class="table-light">
<tr>
<th>Producto</th>
<th>Cantidad</th>
<th>Precio</th>
<th>Subtotal</th>
<th>Acción</th>
</tr>
</thead>
<tbody>
<?php
foreach ($_SESSION['carrito'] as $id => $cant) {
$query = $conexion->query("SELECT * FROM producto WHERE
id_producto = $id");
if ($p = $query->fetch_assoc()) {
$subtotal = $p['val_producto'] * $cant;
$total += $subtotal;
echo "<tr>
<td>{$p['nom_producto']}</td>
<td>$cant</td>
<td>$ {$p['val_producto']}</td>
<td>$ $subtotal</td>
<td><a href='carrito.php?eliminar=$id' class='btn
btn-sm btn-danger'>Eliminar</a></td>
</tr>";
}
}
?>
</tbody>
</table>
<div class="text-end fw-bold fs-5">
Total: $<?= number_format($total, 0, ',', '.') ?>
</div>
<div class="mt-4 text-end">
<a href="../index.php" class="btn btn-secondary">Seguir comprando</a>
<a href="finalizar.php" class="btn btn-success">Finalizar compra</a>
</div>
<?php else: ?>
<p class="alert alert-info">Tu carrito está vacío.</p>
<a href="../index.php" class="btn btn-primary">Volver a la tienda</a>
<?php endif; ?>
</div>
</body>
</html>