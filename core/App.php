<?php
namespace Core;

class App {
    protected $controller = 'App\\Controllers\\HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Verificar si existe el controlador
        if (isset($url[0]) && file_exists('../app/Controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = 'App\\Controllers\\' . ucfirst($url[0]) . 'Controller';
            $controllerName = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        } else {
            $controllerName = 'HomeController';
        }

        // Requerir el controlador
        require_once '../app/Controllers/' . $controllerName . '.php';
        $this->controller = new $this->controller;

        // Verificar si existe el método en la URL
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Obtener parámetros
        $this->params = $url ? array_values($url) : [];

        // Ejecutar el controlador y su método
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
