<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vaciar absolutamente todas las variables de la sesión
$_SESSION = array();

// Destruir las cookies de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión por completo
session_destroy();

// Redirigir a la página de inicio limpia
header("Location: /esc_project/public/");
exit;