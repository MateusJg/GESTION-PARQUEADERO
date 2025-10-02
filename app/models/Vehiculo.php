<?php
class Vehiculo {
    private $conn;
    private $table = "vehiculos";

    public $vehiculo_id;
    public $propietario;
    public $documento;
    public $marca;
    public $color;
    public $placa;
    public $tipo_id;
    public $codigo_qr;
    public $activo;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los vehículos activos
    public function obtenerTodos() {
       $sql = "SELECT v.*, tv.nombre AS tipo_vehiculo 
            FROM " . $this->table . " v 
            INNER JOIN tipos_vehiculos tv ON v.tipo_id = tv.tipo_id";
    return $this->conn->query($sql);
}

    // Buscar por documento
    public function buscarPorDocumento($documento) {
        $sql = "SELECT * FROM " . $this->table . " WHERE documento = :documento LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":documento", $documento);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Guardar nuevo vehículo
    public function guardar() {
        $sql = "INSERT INTO " . $this->table . " 
                (propietario, documento, marca, color, placa, tipo_id, codigo_qr, activo) 
                VALUES (:propietario, :documento, :marca, :color, :placa, :tipo_id, :codigo_qr, 1)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ":propietario" => $this->propietario,
            ":documento"   => $this->documento,
            ":marca"       => $this->marca,
            ":color"       => $this->color,
            ":placa"       => $this->placa,
            ":tipo_id"     => $this->tipo_id,
            ":codigo_qr"   => $this->codigo_qr
        ]);
    }

    // Eliminar vehículo
    public function borrar($documento) {
        $sql = "DELETE FROM " . $this->table . " WHERE documento = :documento";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":documento", $documento);
        return $stmt->execute();
    }
}
?>
