<?php

namespace App\Controllers;

class AdminController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener productos desde la sesión o asignar lista por defecto si está vacía
        $productosLista = $_SESSION['productos'] ?? [
            [
                'id' => 1,
                'nombre' => 'Almohadas (Set x2)',
                'precio' => '100.000',
                'fecha' => '2026-09-28',
                'estado' => 'Disponible'
            ],
            [
                'id' => 2,
                'nombre' => 'Portátil LENOVO OLED',
                'precio' => '2.450.000',
                'fecha' => '2026-09-29',
                'estado' => 'Vendido'
            ],
            [
                'id' => 3,
                'nombre' => 'Juego de Pesas y Mancuernas',
                'precio' => '150.000',
                'fecha' => '2026-10-01',
                'estado' => 'Disponible'
            ]
        ];

        // Lista de Categorías y Términos más buscados
        $masBuscados = [
            [
                'categoria' => 'Laptops & Tecnología (OLED, Gaming)',
                'busquedas' => 342,
                'tendencia' => '+18%'
            ],
            [
                'categoria' => 'Hogar & Descanso (Almohadas Ergonómicas)',
                'busquedas' => 210,
                'tendencia' => '+12%'
            ],
            [
                'categoria' => 'Deportes & Gimnasio (Pesas, Mancuernas)',
                'busquedas' => 185,
                'tendencia' => '+5%'
            ]
        ];

        require_once __DIR__ . '/../Views/admin/index.php';
    }
}