<?php
namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller {

    public function index() {
        $datos = [
            'titulo' => 'E.S.C. - Entrega Segura y Confiable',
            'descripcion' => 'Plataforma de intermediación de confianza (Escrow) para compras y ventas seguras.'
        ];

        $this->view('home/index', $datos);
    }
}
