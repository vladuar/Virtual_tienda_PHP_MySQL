<?php
session_start();
include("../db.php");
if (empty($_SESSION['carrito'])) {
header("Location: index.php");
exit;
}
// Calcular total de la venta
$total = 0;
foreach ($_SESSION['carrito'] as $id => $cant) {
$res = $conexion->query("SELECT val_producto FROM producto WHERE
id_producto = $id");
if ($p = $res->fetch_assoc()) {
$total += $p['val_producto'] * $cant;
}
}
// Insertar en tabla ventas
$conexion->query("INSERT INTO ventas (total) VALUES ($total)");
$id_venta = $conexion->insert_id; // Último ID insertado
// Insertar detalle de cada producto
foreach ($_SESSION['carrito'] as $id => $cant) {
$res = $conexion->query("SELECT val_producto FROM producto WHERE
id_producto = $id");
if ($p = $res->fetch_assoc()) {
$precio = $p['val_producto'];
$subtotal = $precio * $cant;
$conexion->query("INSERT INTO detalle_venta (id_venta, id_producto,
cantidad, precio_unitario, subtotal)
VALUES ($id_venta, $id, $cant, $precio,
$subtotal)");
}
}
// Vaciar carrito
$_SESSION['carrito'] = [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Compra finalizada</title>
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.cs
s" rel="stylesheet">
</head>
<body>
<div class="container py-5">
<div class="alert alert-success text-center">
<h4> ¡Compra realizada con éxito!</h4>
<p>Tu número de venta es: <strong>#<?= $id_venta ?></strong></p>
<p>Total pagado: <strong>$<?= number_format($total, 0, ',', '.')
?></strong></p>
<a href="../index.php" class="btn btn-primary mt-3">Volver a la tienda</a>
</div>
</div>
</body>
</html>