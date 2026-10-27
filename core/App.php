<?php

namespace Core;

class App {

    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // 1. Determinar el controlador
        if (!empty($url[0])) {
            $controllerCandidate = ucfirst($url[0]) . 'Controller';
            $fileCandidate = '../app/Controllers/' . $controllerCandidate . '.php';

            if (file_exists($fileCandidate)) {
                $this->controller = $controllerCandidate;
                unset($url[0]);
            }
        }

        // 2. Requerir e instanciar el controlador con Namespace
        $controllerFile = '../app/Controllers/' . $this->controller . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
        }

        $fullClassName = "App\\Controllers\\" . $this->controller;

        if (class_exists($fullClassName)) {
            $this->controller = new $fullClassName();
        } else if (class_exists($this->controller)) {
            $this->controller = new $this->controller();
        } else {
            die("Error: El controlador '{$this->controller}' no fue encontrado.");
        }

        // 3. Determinar el método
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 4. Parámetros
        $this->params = $url ? array_values($url) : [];

        // 5. Validar ejecución del método de forma segura
        if (method_exists($this->controller, $this->method)) {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else if (method_exists($this->controller, 'index')) {
            call_user_func_array([$this->controller, 'index'], $this->params);
        } else if (method_exists($this->controller, 'login')) {
            call_user_func_array([$this->controller, 'login'], $this->params);
        } else {
            die("Error: El método '{$this->method}' no existe en el controlador.");
        }
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}