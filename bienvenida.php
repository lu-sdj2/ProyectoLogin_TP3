<?php
session_start();
if (!isset($_SESSION['usuario_nombre'])) {
    header("Location: index.php");
    exit();
}
$nombreUsuario = $_SESSION['usuario_nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida - Sistema</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container welcome-box">
        <h1>¡Bienvenido/a, <?php echo htmlspecialchars($nombreUsuario); ?>!</h1>
        <p style="color: var(--text-muted); margin-bottom: 20px;">Has iniciado sesión correctamente en el sistema.</p>
        <a href="logout.php" class="btn" style="display: block; text-decoration: none; text-align: center;">Cerrar Sesión</a>
    </div>
</body>
</html>