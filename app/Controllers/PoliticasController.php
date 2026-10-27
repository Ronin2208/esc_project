<?php

namespace App\Controllers;

class PoliticasController {

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        require_once __DIR__ . '/../Views/politicas/index.php';
    }
}