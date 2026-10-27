<?php

namespace App\Controllers;

class PresentacionController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $mensajeExito = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['foto_presentacion']) && $_FILES['foto_presentacion']['error'] === UPLOAD_ERR_OK) {
                $nombreFoto = 'autor_' . time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($_FILES['foto_presentacion']['name']));
                $dirUploads = $_SERVER['DOCUMENT_ROOT'] . '/esc_project/public/uploads/';

                if (!is_dir($dirUploads)) {
                    mkdir($dirUploads, 0777, true);
                }

                if (move_uploaded_file($_FILES['foto_presentacion']['tmp_name'], $dirUploads . $nombreFoto)) {
                    $_SESSION['foto_presentacion'] = $nombreFoto;
                    $mensajeExito = '¡Foto de presentación actualizada con éxito!';
                }
            }
        }

        require_once __DIR__ . '/../Views/presentacion/index.php';
    }
}