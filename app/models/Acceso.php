<?php
class Acceso {
    private $conn;
    private $table = "accesos";

    public $acceso_id;
    public $vehiculo_id;
    public $fecha_ingreso;
    public $fecha_salida;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Registrar ingreso
    public function registrarIngreso($vehiculo_id) {
        $sql = "INSERT INTO " . $this->table . " (vehiculo_id, fecha_ingreso) VALUES (:vehiculo_id, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":vehiculo_id", $vehiculo_id);
        return $stmt->execute();
    }

    // Registrar salida
    public function registrarSalida($acceso_id) {
        $sql = "UPDATE " . $this->table . " SET fecha_salida = NOW() WHERE acceso_id = :acceso_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":acceso_id", $acceso_id);
        return $stmt->execute();
    }

    // Consultar accesos
    public function consultar() {
        $sql = "SELECT * FROM vista_consulta_accesos ORDER BY fecha_ingreso DESC";
        return $this->conn->query($sql);
    }
}
?>
