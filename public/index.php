<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carga de la configuración de base de datos
require_once __DIR__ . '/../app/Config/Database.php';

// Carga automática de todos los Modelos y Controladores
foreach (glob(__DIR__ . '/../app/Models/*.php') as $filename) {
    require_once $filename;
}
foreach (glob(__DIR__ . '/../app/Controllers/*.php') as $filename) {
    require_once $filename;
}

$url = $_GET['url'] ?? 'home';
$urlParts = explode('/', rtrim($url, '/'));

$controllerName = ucfirst($urlParts[0]) . 'Controller';
$methodName = $urlParts[1] ?? 'index';

// 1. Ruta directa para la HOJA DE PRESENTACIÓN
if ($url === 'presentacion') {
    require_once __DIR__ . '/../app/Controllers/PresentacionController.php';
    $presController = new App\Controllers\PresentacionController();
    $presController->index();
    exit;
}

// 2. Rutas directas para Autenticación y Registro
if ($url === 'auth/login' || $url === 'login') {
    $auth = new App\Controllers\AuthController();
    $auth->login();
    exit;
}

if ($url === 'auth/registro' || $url === 'auth/registrar' || $url === 'registro') {
    $auth = new App\Controllers\AuthController();
    $auth->registrar();
    exit;
}

if ($url === 'auth/logout' || $url === 'logout') {
    $auth = new App\Controllers\AuthController();
    $auth->logout();
    exit;
}

// 3. Ejecución por patrón MVC estándar para el resto de rutas
$controllerClass = "App\\Controllers\\" . $controllerName;

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
        exit;
    }
}

// 4. Cargar Home por defecto
$home = new App\Controllers\HomeController();
$home->index();