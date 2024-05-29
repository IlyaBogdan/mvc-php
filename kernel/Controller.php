<?php 

namespace kernel;

abstract class Controller {
    protected function view($view, $data = []) {
        extract($data);
        require_once APP_ROOT . '/src/Views/' . $view . '.php';
    }

    protected function model($model) {
        require_once APP_ROOT . '/src/Models/' . $model . '.php';
        return new $model();
    }
}