<?php

namespace App\Controllers;

class VentasController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Historial completo de transacciones, compradores y facturas en custodia Escrow
        $ventasHistorial = [
            [
                'factura_id' => 'ESC-2026-001',
                'fecha' => '2026-09-28 14:30',
                'producto' => 'Portátil LENOVO OLED',
                'comprador' => 'Carlos Mendoza',
                'ciudad' => 'Medellín',
                'monto_bruto' => '$2.450.000',
                'ganancia_neta' => '$2.300.000',
                'comision' => '-$150.000',
                'estado' => 'Entregado y Verificado',
                'custodia' => 'Liberada'
            ],
            [
                'factura_id' => 'ESC-2026-002',
                'fecha' => '2026-09-30 10:15',
                'producto' => 'Almohadas (Set x2)',
                'comprador' => 'Andrea Gómez',
                'ciudad' => 'Cali',
                'monto_bruto' => '$100.000',
                'ganancia_neta' => '$94.000',
                'comision' => '-$6.000',
                'estado' => 'Entregado y Verificado',
                'custodia' => 'Liberada'
            ],
            [
                'factura_id' => 'ESC-2026-003',
                'fecha' => '2026-10-14 16:45',
                'producto' => 'Juego de Pesas y Mancuernas',
                'comprador' => 'Felipe Restrepo',
                'ciudad' => 'Bogotá D.C.',
                'monto_bruto' => '$150.000',
                'ganancia_neta' => '$141.000',
                'comision' => '-$9.000',
                'estado' => 'En Custodia / En Transito',
                'custodia' => 'Retenida'
            ]
        ];

        // Productos con mayor demanda
        $topVendidos = [
            ['nombre' => 'Portátil Lenovo OLED 15.6"', 'unidades' => 3, 'total' => '$7.350.000'],
            ['nombre' => 'Almohadas Ergonómicas (Set x2)', 'unidades' => 2, 'total' => '$200.000'],
            ['nombre' => 'Juego de Pesas 20kg', 'unidades' => 1, 'total' => '$150.000']
        ];

        require_once __DIR__ . '/../Views/ventas/index.php';
    }
}