<?php

namespace kernel;

class View {
    public static function render($view, $data = []) {
        extract($data);
        require_once APP_ROOT . '/src/Views/' . $view . '.php';
    }
}