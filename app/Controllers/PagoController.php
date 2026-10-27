<?php

namespace App\Controllers;

class PagoController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = $_GET['id'] ?? 1;
        $productoSeleccionado = null;

        if (isset($_SESSION['productos'])) {
            foreach ($_SESSION['productos'] as $p) {
                if ($p['id'] == $id) {
                    $productoSeleccionado = $p;
                    break;
                }
            }
        }

        require_once __DIR__ . '/../Views/pago/index.php';
    }

    public function procesar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['pago_exitoso'] = true;
        header('Location: /esc_project/public/index.php?url=pago/confirmacion');
        exit;
    }

    public function confirmacion() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        require_once __DIR__ . '/../Views/pago/confirmacion.php';
    }
}