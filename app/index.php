<?php
session_start();

require_once __DIR__ . "/controllers/AuthController.php";
require_once __DIR__ . "/controllers/AdminController.php";
require_once __DIR__ . "/controllers/OperarioController.php";
require_once __DIR__ . "/controllers/AccesoController.php";

// Router básico
$accion = $_GET['accion'] ?? null;

switch ($accion) {
    case "login":
        (new AuthController())->login();
        break;
    case "logout":
        (new AuthController())->logout();
        break;
    case "admin":
        (new AdminController())->index();
        break;
    case "guardarVehiculo":
        (new AdminController())->guardar();
        break;
    case "borrarVehiculo":
        (new AdminController())->borrar();
        break;
    case "qr":
        (new AdminController())->qr();
        break;
    case "operario":
        (new OperarioController())->index();
        break;
    case "consulta":
        (new AccesoController())->consulta();
        break;
    default:
        (new AuthController())->login();
}
