<?php
session_start();
include("../db.php");
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$sql = "SELECT * FROM usuarios WHERE username = '$usuario' AND password
= '$clave'";
$res = $conexion->query($sql);
if ($res->num_rows == 1) {
$_SESSION['admin'] = $usuario;
header("Location: dashboard.php");
exit;
} else {
$error = "Usuario o contraseña incorrectos";
}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Iniciar Sesión</title>
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.cs
s" rel="stylesheet">
</head>
<body>
<div class="container py-5">
<h3 class="text-center mb-4">Login Administrador</h3>
<div class="row justify-content-center">
<div class="col-md-5">
<form method="POST" class="card p-4 shadow-sm">
<?php if ($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>
<div class="mb-3">
<label>Usuario</label>
<input type="text" name="usuario" class="form-control" required>
</div>
<div class="mb-3">
<label>Contraseña</label>
<input type="password" name="clave" class="form-control" required>
</div>
<button class="btn btn-primary w-100">Entrar</button>
</form>
</div>
</div>
</div>
</body>
</html>
