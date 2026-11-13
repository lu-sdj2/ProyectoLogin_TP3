<?php
require_once 'conexion.php';

$error = "";
$exito = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $correo = trim($_POST['correo']);
    $password = $_POST['password'];
    $confirmar_password = $_POST['confirmar_password'];

    if (!empty($nombre) && !empty($apellido) && !empty($correo) && !empty($password)) {
        if ($password === $confirmar_password) {
            $stmtCheck = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
            $stmtCheck->execute([$correo]);
            
            if ($stmtCheck->rowCount() > 0) {
                $error = "El correo electrónico ya está registrado.";
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, correo, password) VALUES (?, ?, ?, ?)");
                if ($stmt->execute([$nombre, $apellido, $correo, $passwordHash])) {
                    $exito = "¡Usuario registrado con éxito! <a href='index.php'>Iniciar sesión</a>";
                } else {
                    $error = "Error al registrar el usuario.";
                }
            }
        } else {
            $error = "Las contraseñas no coinciden.";
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Nuevo Usuario</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Crear Cuenta</h2>
        <?php if (!empty($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (!empty($exito)): ?>
            <div class="error-msg" style="background-color: rgba(0, 255, 0, 0.1); color: #00ffcc; border-color: rgba(0, 255, 0, 0.3);"><?php echo $exito; ?></div>
        <?php endif; ?>
        
        <form id="formRegistro" action="registro.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmar_password">Confirmar Contraseña:</label>
                <input type="password" id="confirmar_password" name="confirmar_password" required>
            </div>
            <button type="submit" class="btn">Registrarse</button>
        </form>
        <div class="link-text">
            ¿Ya tienes cuenta? <a href="index.php">Volver al Login</a>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>