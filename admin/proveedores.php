<?php
include("../db.php");

//se debe registrar

session_start();
if (!isset($_SESSION['admin'])) {
header("Location: login.php");
exit;
}


// Agregar proveedor
if (isset($_POST['agregar'])) {
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$sql = "INSERT INTO proveedor (nom_proveedor, tel_proveedor,
email_proveedor)

VALUES ('$nombre', '$telefono', '$email')";
$conexion->query($sql);
header("Location: proveedores.php");
}
// Eliminar proveedor
if (isset($_GET['eliminar'])) {
$id = $_GET['eliminar'];
$conexion->query("DELETE FROM proveedor WHERE id_proveedor = $id");
header("Location: proveedores.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>CRUD Proveedores</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap 5 -->
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.cs
s" rel="stylesheet">
</head>
<body>
<div class="container py-5">
<h2 class="mb-4 text-center">Gestión de Proveedores</h2>
<!-- Formulario agregar proveedor -->
<div class="card mb-4">
<div class="card-header">Agregar Nuevo Proveedor</div>
<div class="card-body">
<form method="POST">
<div class="row g-3">
<div class="col-md-4">
<label class="form-label">Nombre</label>
<input type="text" name="nombre" class="form-control" required>
</div>
<div class="col-md-4">
<label class="form-label">Teléfono</label>
<input type="text" name="telefono" class="form-control"

required>
</div>
<div class="col-md-4">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" required>
</div>
</div>

<button type="submit" name="agregar" class="btn btn-primary mt-
3">Agregar proveedor</button>

</form>
</div>
</div>
<!-- Tabla de proveedores -->
<div class="card">
<div class="card-header">Listado de Proveedores</div>
<div class="card-body table-responsive">
<table class="table table-bordered table-hover">
<thead class="table-light">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Teléfono</th>
<th>Email</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<?php
$result = $conexion->query("SELECT * FROM proveedor");
while ($p = $result->fetch_assoc()) {
echo "<tr>
<td>{$p['id_proveedor']}</td>
<td>{$p['nom_proveedor']}</td>
<td>{$p['tel_proveedor']}</td>
<td>{$p['email_proveedor']}</td>
<td>
<a

href='proveedores.php?eliminar={$p['id_proveedor']}' class='btn btn-danger
btn-sm' onclick='return confirm(\"¿Eliminar proveedor?\")'>Eliminar</a>

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