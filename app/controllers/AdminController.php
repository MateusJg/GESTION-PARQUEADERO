<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Vehiculo.php";
require_once __DIR__ . "/../models/TipoVehiculo.php";
require_once __DIR__ . "/../libs/phpqrcode.php";

class AdminController {

    public function index() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: index.php");
            exit;
        }

        $db = Database::connect();

        // Vehículos registrados
        $vehiculo = new Vehiculo($db);
        $vehiculos = $vehiculo->obtenerTodos()->fetchAll(PDO::FETCH_ASSOC);

        // 🚀 Cupos disponibles
        $tipo = new TipoVehiculo($db);
        $cupos = $tipo->cuposDisponibles()->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . "/../views/admin.php";
    }

    public function guardar() {
        if ($_SESSION['rol'] !== 'admin') { exit("Acceso denegado"); }

        $db = Database::connect();
        $vehiculo = new Vehiculo($db);

        $vehiculo->propietario = $_POST['propietario'];
        $vehiculo->documento   = $_POST['documento'];
        $vehiculo->marca       = $_POST['marca'];
        $vehiculo->color       = $_POST['color'];
        $vehiculo->placa       = $_POST['placa'];
        $vehiculo->tipo_id     = $_POST['tipo_id'];
        $vehiculo->codigo_qr   = uniqid("QR");

        $vehiculo->guardar();

        header("Location: index.php?accion=admin");
    }

    public function borrar() {
        if ($_SESSION['rol'] !== 'admin') { exit("Acceso denegado"); }

        $db = Database::connect();
        $vehiculo = new Vehiculo($db);
        $vehiculo->borrar($_POST['documento']);

        header("Location: index.php?accion=admin");
    }

    public function qr() {
        if ($_SESSION['rol'] !== 'admin') { exit("Acceso denegado"); }

        $db = Database::connect();
        $vehiculo = new Vehiculo($db);

        $datos = $vehiculo->buscarPorDocumento($_GET['doc']);
        if ($datos) {
            $contenido = "Vehículo: " . $datos['placa'] . "\n"
                       . "Propietario: " . $datos['propietario'] . "\n"
                       . "Documento: " . $datos['documento'] . "\n"
                       . "Código: " . $datos['codigo_qr'];

            header('Content-Type: image/png');
            \QRcode::png($contenido, false, QR_ECLEVEL_L, 6);
        } else {
            echo "No encontrado";
        }
    }
}
