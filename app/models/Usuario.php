<?php
class Usuario {
    private $conn;
    private $table = "operarios";

    public $usuario;
    public $password;
    public $rol;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($usuario, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE usuario = :usuario AND activo = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && hash("sha256", $password) === $row['password']) {
            $this->usuario = $row['usuario'];
            $this->rol = $row['rol'];
            return true;
        }
        return false;
    }
}
?>
    