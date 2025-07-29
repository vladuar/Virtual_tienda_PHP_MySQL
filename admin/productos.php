<?php
include("../db.php");

// debe estar registrado
session_start();
if (!isset($_SESSION['admin'])) {
header("Location: login.php");
exit;
}



// Agregar producto
if (isset($_POST['agregar'])) {
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$valor = $_POST['valor'];
$id_categoria = $_POST['categoria'];
$id_proveedor = $_POST['proveedor'];
// Subir imagen
$imagen = $_FILES['imagen']['name'];
$ruta = "../uploads/" . $imagen;
move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
$sql = "INSERT INTO producto (nom_producto, des_producto, val_producto,
img_producto, id_categoria, id_proveedor)

VALUES ('$nombre', '$descripcion', $valor, '$imagen',

$id_categoria, $id_proveedor)";
$conexion->query($sql);
header("Location: productos.php");
}

// Eliminar producto
if (isset($_GET['eliminar'])) {
$id = $_GET['eliminar'];
$conexion->query("DELETE FROM producto WHERE id_producto = $id");
header("Location: productos.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD de Productos</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap 5 -->
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.cs
s" rel="stylesheet">
</head>
<body>
<div class="container py-5">
<h2 class="mb-4 text-center">Gestión de Productos</h2>
<!-- Formulario agregar producto -->
<div class="card mb-4">
<div class="card-header">Agregar nuevo producto</div>
<div class="card-body">
<form method="POST" enctype="multipart/form-data">
<div class="row g-3">
<div class="col-md-4">
<label class="form-label">Nombre</label>
<input type="text" name="nombre" class="form-control" required>
</div>
<div class="col-md-4">
<label class="form-label">Descripción</label>
<input type="text" name="descripcion" class="form-control"

required>
</div>
<div class="col-md-4">
<label class="form-label">Valor</label>
<input type="number" name="valor" class="form-control" required>
</div>
<div class="col-md-4">
<label class="form-label">Imagen</label>

<input type="file" name="imagen" class="form-control"

accept="image/*" required>

</div>
<div class="col-md-4">
<label class="form-label">Categoría</label>
<select name="categoria" class="form-select" required>
<option value="">Seleccione una categoría</option>
<?php
$categorias = $conexion->query("SELECT * FROM categoria");
while ($cat = $categorias->fetch_assoc()) {
echo "<option

value='{$cat['id_categoria']}'>{$cat['nom_categoria']}</option>";

}
?>
</select>
</div>
<div class="col-md-4">
<label class="form-label">Proveedor</label>
<select name="proveedor" class="form-select" required>
<option value="">Seleccione un proveedor</option>
<?php
$proveedores = $conexion->query("SELECT * FROM proveedor");
while ($prov = $proveedores->fetch_assoc()) {
echo "<option

value='{$prov['id_proveedor']}'>{$prov['nom_proveedor']}</option>";

}
?>
</select>
</div>
</div>

<button type="submit" name="agregar" class="btn btn-primary mt-
3">Agregar producto</button>

</form>
</div>
</div>
<!-- Tabla de productos -->
<div class="card">
<div class="card-header">Listado de productos</div>
<div class="card-body table-responsive">
<table class="table table-bordered table-hover">
<thead class="table-light">
<tr>
<th>ID</th>
<th>Nombre</th>

<th>Descripción</th>
<th>Valor</th>
<th>Imagen</th>
<th>Categoría</th>
<th>Proveedor</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT p.*, c.nom_categoria, pr.nom_proveedor FROM

producto p

JOIN categoria c ON p.id_categoria = c.id_categoria
JOIN proveedor pr ON p.id_proveedor = pr.id_proveedor";
$productos = $conexion->query($sql);
while ($p = $productos->fetch_assoc()) {
echo "<tr>
<td>{$p['id_producto']}</td>
<td>{$p['nom_producto']}</td>
<td>{$p['des_producto']}</td>
<td>$ {$p['val_producto']}</td>
<td><img src='../uploads/{$p['img_producto']}'

width='80'></td>

<td>{$p['nom_categoria']}</td>
<td>{$p['nom_proveedor']}</td>
<td>
<a href='productos.php?eliminar={$p['id_producto']}'

class='btn btn-danger btn-sm' onclick='return confirm(\"¿Eliminar
producto?\")'>Eliminar</a>
</td>
</tr>";

}
?>
</tbody>
</table>
</div>
</div>
</div>
</body>
</html>