<!DOCTYPE html>
<html>
<head>
    <title>Gestión Parqueadero - Acceso</title>
    <meta charset="UTF-8">
</head>
<body>
    <h2>GESTION DE PARQUEADERO<br>ACCESO</h2>

    <form method="POST" action="index.php">
        <label><input type="radio" name="rol" value="admin" required> Administrador</label>
        <label><input type="radio" name="rol" value="operario" required> Operario</label>
        <br><br>
        <label>NOMBRE: <input type="text" name="usuario" required></label><br>
        <label>CONTRASEÑA: <input type="password" name="password" required></label><br><br>
        <button type="submit">Login</button>
    </form>

    <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
</body>
</html>
