<?php
namespace App\Controllers;

use Core\Controller;

class AuthController extends Controller {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = $this->model('UsuarioModel');
    }

    // Si entras a /auth/ directo, abre el login por defecto
    public function index() {
        $this->login();
    }

    public function login() {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: /esc_project/public/home');
            exit();
        }

        $data = ['error' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $data['error'] = 'Por favor, ingrese todos los campos.';
            } else {
                $usuario = $this->usuarioModel->obtenerPorEmail($email);

                if ($usuario && password_verify($password, $usuario['password'])) {
                    if ($usuario['estado'] !== 'activo') {
                        $data['error'] = 'Tu cuenta se encuentra inactiva o suspendida.';
                    } else {
                        $_SESSION['usuario_id'] = $usuario['id'];
                        $_SESSION['usuario_nombre'] = $usuario['nombre'];
                        $_SESSION['usuario_rol'] = $usuario['rol'];

                        header('Location: /esc_project/public/home');
                        exit();
                    }
                } else {
                    $data['error'] = 'Credenciales incorrectas. Verifique su correo o contraseña.';
                }
            }
        }

        $this->view('auth/login', $data);
    }

    public function registro() {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: /esc_project/public/home');
            exit();
        }

        $data = ['error' => '', 'exito' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre    = trim($_POST['nombre'] ?? '');
            $email     = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $password  = trim($_POST['password'] ?? '');
            $telefono  = trim($_POST['telefono'] ?? '');
            $documento = trim($_POST['documento'] ?? '');
            $rol       = trim($_POST['rol'] ?? 'comprador');

            if (empty($nombre) || empty($email) || empty($password) || empty($telefono) || empty($documento)) {
                $data['error'] = 'Todos los campos son obligatorios.';
            } elseif ($this->usuarioModel->obtenerPorEmail($email)) {
                $data['error'] = 'El correo electrónico ya se encuentra registrado.';
            } elseif ($this->usuarioModel->obtenerPorDocumento($documento)) {
                $data['error'] = 'El documento de identidad ya se encuentra registrado.';
            } else {
                $registrado = $this->usuarioModel->registrar([
                    'nombre'    => $nombre,
                    'email'     => $email,
                    'password'  => $password,
                    'telefono'  => $telefono,
                    'documento' => $documento,
                    'rol'       => in_array($rol, ['comprador', 'vendedor']) ? $rol : 'comprador'
                ]);

                if ($registrado) {
                    $data['exito'] = '¡Registro completado con éxito! Ya puedes iniciar sesión.';
                } else {
                    $data['error'] = 'Ocurrió un error al registrar la cuenta. Intente de nuevo.';
                }
            }
        }

        $this->view('auth/registro', $data);
    }

    public function logout() {
        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nombre']);
        unset($_SESSION['usuario_rol']);
        session_destroy();

        header('Location: /esc_project/public/auth/login');
        exit();
    }
}