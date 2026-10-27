<?php

namespace App\Controllers;

class PerfilController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 1. Inicializar datos por defecto del perfil si no existen
        if (!isset($_SESSION['usuario_perfil'])) {
            $_SESSION['usuario_perfil'] = [
                'nombre' => $_SESSION['usuario_nombre'] ?? 'Jose Alejandro Cortes',
                'email' => 'jose.cortes@esc.com.co',
                'telefono' => '300 123 4567',
                'ciudad' => 'Bogotá D.C.',
                'direccion' => 'Calle 100 #15-20',
                'rol' => 'Comprador y Vendedor',
                'foto' => '',
                'ambiente' => 'dark',         // dark, neon, green, purple, light, gradient
                'color_accent' => '#0dcaf0',     // #0dcaf0, #0d6efd, #198754, #d63384, #fd7e14, #ffc107
                'efecto' => 'glow',              // glow, glass, floating, border-pulse
                'calificacion' => '5.0',
                'ventas_completadas' => 3
            ];
        }

        // 2. Procesar el formulario de guardado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['usuario_perfil']['nombre'] = $_POST['nombre'] ?? $_SESSION['usuario_perfil']['nombre'];
            $_SESSION['usuario_nombre'] = $_SESSION['usuario_perfil']['nombre'];
            $_SESSION['usuario_perfil']['telefono'] = $_POST['telefono'] ?? $_SESSION['usuario_perfil']['telefono'];
            $_SESSION['usuario_perfil']['ciudad'] = $_POST['ciudad'] ?? $_SESSION['usuario_perfil']['ciudad'];
            $_SESSION['usuario_perfil']['direccion'] = $_POST['direccion'] ?? $_SESSION['usuario_perfil']['direccion'];
            $_SESSION['usuario_perfil']['rol'] = $_POST['rol'] ?? $_SESSION['usuario_perfil']['rol'];
            $_SESSION['usuario_perfil']['ambiente'] = $_POST['ambiente'] ?? 'dark';
            $_SESSION['usuario_perfil']['color_accent'] = $_POST['color_accent'] ?? '#0dcaf0';
            $_SESSION['usuario_perfil']['efecto'] = $_POST['efecto'] ?? 'none';

            // Subida de foto de perfil
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $nombreFoto = 'perfil_' . time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($_FILES['foto']['name']));
                $dirUploads = $_SERVER['DOCUMENT_ROOT'] . '/esc_project/public/uploads/';
                
                if (!is_dir($dirUploads)) {
                    mkdir($dirUploads, 0777, true);
                }

                if (move_uploaded_file($_FILES['foto']['tmp_name'], $dirUploads . $nombreFoto)) {
                    $_SESSION['usuario_perfil']['foto'] = $nombreFoto;
                }
            }

            $mensajeExito = "¡Perfil, ambiente, colores y efectos guardados con éxito!";
        }

        $perfil = $_SESSION['usuario_perfil'];
        $misProductos = $_SESSION['productos'] ?? [];

        require_once __DIR__ . '/../Views/perfil/index.php';
    }
}