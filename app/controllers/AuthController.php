<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../models/Usuario.php";

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = Database::connect();
            $usuario = new Usuario($db);

            $user = $_POST['usuario'];
            $pass = $_POST['password'];
            $rol  = $_POST['rol'];

            if ($usuario->login($user, $pass) && $usuario->rol === $rol) {
                $_SESSION['usuario'] = $usuario->usuario;
                $_SESSION['rol'] = $usuario->rol;

                if ($rol === "admin") {
                    header("Location: index.php?accion=admin");
                } else {
                    header("Location: index.php?accion=operario");
                }
                exit;
            } else {
                $error = "Credenciales inválidas";
                include __DIR__ . "/../views/login.php";
            }
        } else {
            include __DIR__ . "/../views/login.php";
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
    }
}
