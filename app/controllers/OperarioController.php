<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Acceso.php";
require_once __DIR__ . "/../models/TipoVehiculo.php";

class OperarioController {
    public function index() {
        if ($_SESSION['rol'] !== 'operario') {
            header("Location: index.php");
            exit;
        }

        $db = Database::connect();

        // Último ingreso
        $sqlIngreso = "SELECT a.fecha_ingreso, v.propietario, v.documento, tv.nombre AS tipo_vehiculo 
                       FROM accesos a
                       INNER JOIN vehiculos v ON a.vehiculo_id = v.vehiculo_id
                       INNER JOIN tipos_vehiculos tv ON v.tipo_id = tv.tipo_id
                       ORDER BY a.acceso_id DESC LIMIT 1";
        $ultimoIngreso = $db->query($sqlIngreso)->fetch(PDO::FETCH_ASSOC);

        // Última salida
        $sqlSalida = "SELECT a.fecha_salida, v.propietario, v.documento, tv.nombre AS tipo_vehiculo 
                      FROM accesos a
                      INNER JOIN vehiculos v ON a.vehiculo_id = v.vehiculo_id
                      INNER JOIN tipos_vehiculos tv ON v.tipo_id = tv.tipo_id
                      WHERE a.fecha_salida IS NOT NULL
                      ORDER BY a.acceso_id DESC LIMIT 1";
        $ultimaSalida = $db->query($sqlSalida)->fetch(PDO::FETCH_ASSOC);

        // Cupos disponibles
        $tipo = new TipoVehiculo($db);
        $cupos = $tipo->cuposDisponibles()->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . "/../views/operario.php";
    }
}
