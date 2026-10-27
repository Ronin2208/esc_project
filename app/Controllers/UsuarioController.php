<?php

namespace App\Controllers;

class UsuarioController {

    public function index() {
        $this->perfil();
    }

    public function perfil() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /esc_project/public/index.php?url=auth/login');
            exit;
        }

        require_once '../app/Views/usuario/perfil.php';
    }

    public function actualizarPerfil() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['nombre'])) {
                $_SESSION['usuario_nombre'] = trim($_POST['nombre']);
            }
            if (isset($_POST['telefono'])) {
                $_SESSION['usuario_telefono'] = trim($_POST['telefono']);
            }
            if (isset($_POST['direccion'])) {
                $_SESSION['usuario_direccion'] = trim($_POST['direccion']);
            }

            // Procesar la subida de imagen de perfil
            if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['foto_perfil']['tmp_name'];
                $fileName = $_FILES['foto_perfil']['name'];
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $allowed = ['jpg', 'jpeg', 'png', 'webp'];

                if (in_array($ext, $allowed)) {
                    $targetDir = '../public/uploads/perfiles/';
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }

                    $newFileName = 'user_' . ($_SESSION['usuario_id'] ?? '1') . '_' . time() . '.' . $ext;
                    
                    if (move_uploaded_file($tmpName, $targetDir . $newFileName)) {
                        $_SESSION['usuario_foto'] = $newFileName;
                    }
                }
            }
        }

        header('Location: /esc_project/public/index.php?url=usuario/perfil');
        exit;
    }
}