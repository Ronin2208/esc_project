<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión PHP
session_start();

// Cargar la configuración global
require_once '../config.php';
require_once '../app/config/Database.php';

// Cargar las clases base
require_once '../core/App.php';
require_once '../core/Controller.php';

// Instanciar la aplicación
$app = new Core\App();

