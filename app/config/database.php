<?php
class Database {
    private static $host = "localhost";
    private static $db_name = "parqueadero";
    private static $username = "root";   // cambia si tu MySQL usa otro usuario
    private static $password = "123456";       // pon tu contraseña de MySQL si tienes
    private static $conn;

    public static function connect() {
        if (self::$conn == null) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db_name,
                    self::$username,
                    self::$password
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
