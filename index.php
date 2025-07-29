<?php
session_start();
include("db.php");
// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
$_SESSION['carrito'] = [];
}
// Agregar producto al carrito
if (isset($_POST['agregar_carrito'])) {
$id = $_POST['producto_id'];
$cantidad = 1;
if (isset($_SESSION['carrito'][$id])) {
$_SESSION['carrito'][$id] += $cantidad;
} else {
$_SESSION['carrito'][$id] = $cantidad;
}
header("Location: index.php");
exit;
}
// Calcular total productos y valor
$total_items = array_sum($_SESSION['carrito']);
$total_valor = 0;
foreach ($_SESSION['carrito'] as $id => $cant) {
$query = $conexion->query("SELECT val_producto FROM producto WHERE
id_producto = $id");
if ($p = $query->fetch_assoc()) {
$total_valor += $p['val_producto'] * $cant;
}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Tienda PHP</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.cs
s" rel="stylesheet">
<style>
.carrito-icono {
position: relative;
}
.carrito-badge {
position: absolute;
top: -10px;
right: -10px;
background: red;
color: white;
border-radius: 50%;
font-size: 0.75rem;
padding: 4px 7px;
}
</style>
</head>
<body>
<div class="container py-4">
<!-- ENCABEZADO CARRITO -->
<div class="d-flex justify-content-end mb-4">
<a href="admin/carrito.php" class="btn btn-outline-dark carrito-icono
position-relative">
🛒 Carrito
<?php if ($total_items > 0): ?>
<span class="carrito-badge"><?= $total_items ?></span>
<?php endif; ?>
</a>
<?php if ($total_items > 0): ?>
<span class="ms-3 fw-bold text-success align-self-center">$<?=
number_format($total_valor, 0, ',', '.') ?></span>
<?php endif; ?>
</div>
<!-- TÍTULO -->
<h1 class="text-center mb-4">Lista de Productos</h1>
<!-- LISTA DE PRODUCTOS -->
<div class="row">
<?php
$sql = "SELECT producto.*, categoria.nom_categoria FROM producto
INNER JOIN categoria ON producto.id_categoria =
categoria.id_categoria";
$result = $conexion->query($sql);
while($p = $result->fetch_assoc()) {
$imagen = file_exists("uploads/{$p['img_producto']}") ?
"uploads/{$p['img_producto']}" : "uploads/default.jpg";
echo "<div class='col-md-4 mb-4'>
<div class='card h-100'>
<img src='$imagen' class='card-img-top'
style='height:200px; object-fit:cover;'>
<div class='card-body'>
<h5 class='card-title'>{$p['nom_producto']}</h5>
<p class='card-text'>{$p['des_producto']}</p>
<p class='fw-bold text-success'>$
{$p['val_producto']}</p>
<p class='text-muted'>Categoría:
{$p['nom_categoria']}</p>
<form method='POST'>
<input type='hidden' name='producto_id'
value='{$p['id_producto']}'>
<button type='submit' name='agregar_carrito'
class='btn btn-primary w-100'>Agregar al carrito</button>
</form>
</div>
</div>
</div>";
}
?>
</div>
</div>
</body>
</html>