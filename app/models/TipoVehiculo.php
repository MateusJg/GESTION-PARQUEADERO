<?php
class TipoVehiculo {
    private $conn;
    private $table = "tipos_vehiculos";

    public $tipo_id;
    public $nombre;
    public $cupos;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los tipos
    public function obtenerTodos() {
        $sql = "SELECT * FROM " . $this->table;
        return $this->conn->query($sql);
    }

    // Consultar cupos disponibles (vista SQL)
    public function cuposDisponibles() {
        $sql = "SELECT * FROM vista_cupos_disponibles";
        return $this->conn->query($sql);
    }
}
?>
