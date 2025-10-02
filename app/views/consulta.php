<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Consulta de Accesos</title></head>
<body>
<h2>GESTION DE PARQUEADERO<br>CONSULTA DE ACCESOS</h2>

<table border="1">
<tr>
<th>Ingreso</th><th>Salida</th><th>Documento</th>
<th>Propietario</th><th>Tipo</th><th>Marca</th><th>Color</th><th>Placa</th>
</tr>
<?php foreach ($accesos as $a): ?>
<tr>
<td><?= $a['fecha_ingreso'] ?></td>
<td><?= $a['fecha_salida'] ?></td>
<td><?= $a['documento'] ?></td>
<td><?= $a['propietario'] ?></td>
<td><?= $a['tipo_vehiculo'] ?></td>
<td><?= $a['marca'] ?></td>
<td><?= $a['color'] ?></td>
<td><?= $a['placa'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<a href="operario.php">Volver a Operador</a>
</body>
</html>
