<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Rol Operario</title></head>
<body>
<h2>GESTION DE PARQUEADERO<br>ROL OPERARIO</h2>

<h3>Último Ingreso</h3>
<p>Hora: <?= $ultimoIngreso['fecha_ingreso'] ?? '-' ?><br>
Propietario: <?= $ultimoIngreso['propietario'] ?? '-' ?><br>
Documento: <?= $ultimoIngreso['documento'] ?? '-' ?><br>
Vehículo: <?= $ultimoIngreso['tipo_vehiculo'] ?? '-' ?></p>

<h3>Última Salida</h3>
<p>Hora: <?= $ultimaSalida['fecha_salida'] ?? '-' ?><br>
Propietario: <?= $ultimaSalida['propietario'] ?? '-' ?><br>
Documento: <?= $ultimaSalida['documento'] ?? '-' ?><br>
Vehículo: <?= $ultimaSalida['tipo_vehiculo'] ?? '-' ?></p>

<h3>Cupos Disponibles</h3>
<table border="1">
<tr><th>Tipo</th><th>Disponibles</th></tr>
<?php foreach ($cupos as $c): ?>
<tr>
    <td><?= $c['tipo_vehiculo'] ?></td>
    <td><?= $c['cupos_disponibles'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<a href="../controllers/AccesoController.php?accion=consulta">Consulta Accesos</a> |
<a href="../controllers/AuthController.php?accion=logout">Salir</a>
</body>
</html>
