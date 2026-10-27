<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class AuthController {

    // Método para Iniciar Sesión
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (!empty($email) && !empty($password)) {
                $usuarioModel = new UsuarioModel();
                $usuario = $usuarioModel->buscarPorEmail($email);

                // Comprobar existencia y validar contraseña encriptada
                if ($usuario && password_verify($password, $usuario['password'])) {
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['usuario_nombre'] = $usuario['nombre'];
                    $_SESSION['usuario_email'] = $usuario['email'];

                    header("Location: /esc_project/public/");
                    exit;
                } else {
                    $error = "El correo o la contraseña son incorrectos.";
                }
            } else {
                $error = "Por favor ingresa tu correo y contraseña.";
            }
        }

        require_once __DIR__ . '/../Views/auth/login.php';
    }

    // Método para Registrarse con validación Regex
    public function registrar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $rol = $_POST['rol'] ?? 'Comprador y Vendedor';

            // Expresión regular requerida para la contraseña
            $regex = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/m';

            if (empty($nombre) || empty($email) || empty($password)) {
                $error = "Por favor completa todos los campos requeridos.";
            } elseif (!preg_match($regex, $password)) {
                $error = "La contraseña no cumple con los requisitos: Mínimo 8 caracteres, incluir al menos una mayúscula, una minúscula y un número.";
            } else {
                $usuarioModel = new UsuarioModel();

                if ($usuarioModel->buscarPorEmail($email)) {
                    $error = "El correo electrónico ya se encuentra registrado.";
                } else {
                    $exito = $usuarioModel->registrar($nombre, $email, $password, $rol);

                    if ($exito) {
                        $nuevoUsuario = $usuarioModel->buscarPorEmail($email);
                        $_SESSION['usuario_id'] = $nuevoUsuario['id'] ?? null;
                        $_SESSION['usuario_nombre'] = $nombre;
                        $_SESSION['usuario_email'] = $email;
                        
                        header("Location: /esc_project/public/");
                        exit;
                    } else {
                        $error = "Ocurrió un error al intentar guardar en la base de datos.";
                    }
                }
            }
        }

        require_once __DIR__ . '/../Views/auth/registro.php';
    }

    // Método para Cerrar Sesión
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        header("Location: /esc_project/public/");
        exit;
    }
}