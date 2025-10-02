<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestión Parqueadero - Administrador</title>
</head>
<body>
    <h2>GESTIÓN DE PARQUEADERO<br>ROL ADMINISTRADOR</h2>

    <h3>Registrar Vehículo</h3>
    <form method="POST" action="index.php?accion=guardarVehiculo">
        Documento: <input type="text" name="documento" required><br>
        Propietario: <input type="text" name="propietario" required><br>
        Tipo vehículo: 
        <select name="tipo_id">
            <option value="1">Carro</option>
            <option value="2">Moto</option>
            <option value="3">Bici/Patineta</option>
        </select><br>
        Marca: <input type="text" name="marca"><br>
        Color: <input type="text" name="color"><br>
        Placa: <input type="text" name="placa" required><br>
        <button type="submit">Guardar</button>
    </form>

    <h3>Vehículos Registrados</h3>
    <table border="1">
        <tr>
            <th>Documento</th>
            <th>Propietario</th>
            <th>Tipo</th>
            <th>Marca</th>
            <th>Color</th>
            <th>Placa</th>
            <th>QR</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($vehiculos as $v): ?>
        <tr>
            <td><?= $v['documento'] ?></td>
            <td><?= $v['propietario'] ?></td>
            <td><?= $v['tipo_vehiculo'] ?></td>
            <td><?= $v['marca'] ?></td>
            <td><?= $v['color'] ?></td>
            <td><?= $v['placa'] ?></td>
            <td>
                <a href="index.php?accion=qr&doc=<?= $v['documento'] ?>" target="_blank">
                    Imprimir QR
                </a>
            </td>
            <td>
                <form method="POST" action="index.php?accion=borrarVehiculo" style="display:inline;">
                    <input type="hidden" name="documento" value="<?= $v['documento'] ?>">
                    <button type="submit" onclick="return confirm('¿Eliminar este vehículo?')">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Tipo Disponibles</h3>
    <table border="1">
        <tr><th>Tipo</th><th>Cupos disponibles</th></tr>
        <?php foreach ($cupos as $c): ?>
        <tr>
            <td><?= $c['tipo_vehiculo'] ?></td>
            <td><?= $c['cupos_disponibles'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="index.php?accion=logout">Cerrar Sesión</a>
</body>
</html>
