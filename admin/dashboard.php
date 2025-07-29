<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Dashboard Administrativo</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap 5 -->
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.cs
s" rel="stylesheet">
<style>
body {
background-color: #f8f9fa;
}
.card:hover {
transform: scale(1.02);
transition: 0.3s ease-in-out;
}
</style>
</head>
<body>
<div class="container py-5">

<h1 class="text-center mb-4">Panel de Administración</h1>
<div class="row justify-content-center g-4">
<!-- Productos -->
<div class="col-md-4">
<div class="card shadow-sm border-0 h-100">
<div class="card-body text-center">
<h4 class="card-title">Productos</h4>
<p class="card-text">Gestiona todos los productos disponibles.</p>
<a href="productos.php" class="btn btn-primary w-100">Ir a

Productos</a>
</div>
</div>
</div>
<!-- Categorías -->
<div class="col-md-4">
<div class="card shadow-sm border-0 h-100">
<div class="card-body text-center">
<h4 class="card-title">Categorías</h4>
<p class="card-text">Administra las categorías de productos.</p>
<a href="categorias.php" class="btn btn-success w-100">Ir a

Categorías</a>
</div>
</div>
</div>
<!-- Proveedores -->
<div class="col-md-4">
<div class="card shadow-sm border-0 h-100">
<div class="card-body text-center">
<h4 class="card-title">Proveedores</h4>
<p class="card-text">Gestiona los proveedores registrados.</p>
<a href="proveedores.php" class="btn btn-warning w-100">Ir a

Proveedores</a>
</div>
</div>
</div>
</div>
<!-- boton para cerrar sesion -->
<a href="logout.php" class="btn btn-outline-danger float-end">cerrar sesion </a> 
</div>
</body>
</html>