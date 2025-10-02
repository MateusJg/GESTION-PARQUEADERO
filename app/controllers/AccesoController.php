<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Acceso.php";

class AccesoController {
    public function consulta() {
        if ($_SESSION['rol'] !== 'operario') {
            header("Location: index.php");
            exit;
        }

        $db = Database::connect();
        $acceso = new Acceso($db);
        $accesos = $acceso->consultar()->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . "/../views/consulta.php";
    }
}
