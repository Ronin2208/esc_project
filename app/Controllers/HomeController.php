<?php

namespace App\Controllers;

class HomeController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Catálogo principal con imágenes garantizadas vía URL web directa
        if (!isset($_SESSION['productos']) || !is_array($_SESSION['productos']) || empty($_SESSION['productos'])) {
            $_SESSION['productos'] = [
                [
                    'id' => 1,
                    'nombre' => 'Almohadas (Set x2)',
                    'descripcion' => 'Set x 2 Almohadas ergonómicas diseñadas para mantener la columna alineada y relajar los músculos del cuello.',
                    'precio' => '46.000',
                    'imagen_url' => 'https://images.unsplash.com/photo-1584100936595-c0654b55a2e2?w=600&auto=format&fit=crop&q=80'
                ],
                [
                    'id' => 2,
                    'nombre' => 'Portátil LENOVO OLED',
                    'descripcion' => 'Portátil LENOVO IdeaPad Slim 3 AMD Ryzen 7 7735HS, 24 GB RAM, 1 TB SSD, Pantalla OLED 15.6".',
                    'precio' => '2.450.000',
                    'imagen_url' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=600&auto=format&fit=crop&q=80'
                ],
                [
                    'id' => 3,
                    'nombre' => 'Juego de Pesas y Mancuernas',
                    'descripcion' => 'Set de mancuernas ajustables de 20 kg con barra de extensión antideslizante para entrenamiento en casa.',
                    'precio' => '150.000',
                    'imagen_url' => 'https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?w=600&auto=format&fit=crop&q=80'
                ]
            ];
        }

        $productos = $_SESSION['productos'];
        $dirUploads = __DIR__ . '/../../public/uploads/';

        // Mapeo dinámico para productos subidos o sin imagen
        foreach ($productos as $i => $prod) {
            if (!empty($prod['imagen']) && file_exists($dirUploads . $prod['imagen'])) {
                $productos[$i]['imagen_url'] = '/esc_project/public/uploads/' . $prod['imagen'];
            } elseif (empty($prod['imagen_url'])) {
                $nombreLower = strtolower($prod['nombre'] ?? '');
                if (strpos($nombreLower, 'almohada') !== false) {
                    $productos[$i]['imagen_url'] = 'https://images.unsplash.com/photo-1584100936595-c0654b55a2e2?w=600&auto=format&fit=crop&q=80';
                } elseif (strpos($nombreLower, 'lenovo') !== false || strpos($nombreLower, 'hp') !== false || strpos($nombreLower, 'laptop') !== false || strpos($nombreLower, 'portatil') !== false) {
                    $productos[$i]['imagen_url'] = 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=600&auto=format&fit=crop&q=80';
                } elseif (strpos($nombreLower, 'pesas') !== false || strpos($nombreLower, 'mancuernas') !== false) {
                    $productos[$i]['imagen_url'] = 'https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?w=600&auto=format&fit=crop&q=80';
                } else {
                    $productos[$i]['imagen_url'] = 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&auto=format&fit=crop&q=80';
                }
            }
        }

        require_once __DIR__ . '/../Views/home/index.php';
    }
}