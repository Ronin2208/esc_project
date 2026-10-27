<?php
namespace App\Controllers;

use Core\Controller;

class UsuarioController extends Controller {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = $this->model('UsuarioModel');
    }

    public function index() {
        $usuarios = $this->usuarioModel->obtenerTodos();
        $this->view('usuarios/index', ['usuarios' => $usuarios, 'titulo' => 'Gestión de Usuarios']);
    }

    // ... resto de tus métodos (editar, actualizar, eliminar)
}