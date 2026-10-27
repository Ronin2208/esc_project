<?php
namespace Core;

class Controller {

    // Cargar modelo
    public function model($model) {
        $file = '../app/models/' . $model . '.php';
        
        if (file_exists($file)) {
            require_once $file;
        }

        $modelClass = "App\\Models\\" . $model;
        return new $modelClass();
    }

    // Cargar vista
    public function view($view, $data = []) {
        extract($data);
        
        $fileViews = '../app/Views/' . $view . '.php';
        $fileviews = '../app/views/' . $view . '.php';

        if (file_exists($fileViews)) {
            require_once $fileViews;
        } else if (file_exists($fileviews)) {
            require_once $fileviews;
        } else {
            die('La vista no existe.');
        }
    }
}