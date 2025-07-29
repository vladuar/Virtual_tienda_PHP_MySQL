<?php
include("../db.php");

// se debe registrar 
session_start();
if (!isset($_SESSION['admin'])) {
header("Location: login.php");
exit;
}



// Agregar categoría
if (isset($_POST['agregar'])) {
$nombre = $_POST['nombre'];
$sql = "INSERT INTO categoria (nom_categoria) VALUES ('$nombre')";
$conexion->query($sql);
header("Location: categorias.php");
}
// Eliminar categoría
if (isset($_GET['eliminar'])) {
$id = $_GET['eliminar'];
$conexion->query("DELETE FROM categoria WHERE id_categoria = $id");
header("Location: categorias.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD Categorías</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap 5 -->
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.cs
s" rel="stylesheet">
</head>
<body>
<div class="container py-5">
<h2 class="mb-4 text-center">Gestión de Categorías</h2>
<!-- Formulario agregar categoría -->
<div class="card mb-4">
<div class="card-header">Agregar Nueva Categoría</div>
<div class="card-body">
<form method="POST">
<div class="row g-3 align-items-center">
<div class="col-md-9">
<label class="form-label">Nombre de la Categoría</label>
<input type="text" name="nombre" class="form-control" required>
</div>
<div class="col-md-3">
<button type="submit" name="agregar" class="btn btn-success w100 mt-4">Agregar</button>
</div>
</div>
</form>
</div>
</div>
<!-- Tabla categorías -->
<div class="card">
<div class="card-header">Listado de Categorías</div>
<div class="card-body table-responsive">
<table class="table table-bordered table-hover">
<thead class="table-light">
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<?php
$result = $conexion->query("SELECT * FROM categoria");
while ($cat = $result->fetch_assoc()) {
echo "<tr>
<td>{$cat['id_categoria']}</td>
<td>{$cat['nom_categoria']}</td>
<td>
<a
href='categorias.php?eliminar={$cat['id_categoria']}' class='btn btn-danger
btn-sm' onclick='return confirm(\"¿Eliminar esta categoría?\")'>Eliminar</a>
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