<?php
namespace Core;

class Controller {

    // Cargar modelo
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        $modelClass = "App\\Models\\" . $model;
        return new $modelClass();
    }

    // Cargar vista
    public function view($view, $data = []) {
        extract($data);
        if (file_exists('../app/Views/' . $view . '.php')) {
            require_once '../app/Views/' . $view . '.php';
        } else {
            die('La vista no existe.');
        }
    }
}