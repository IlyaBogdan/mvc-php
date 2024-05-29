<?php 

namespace kernel;

/**
 * Base Controller class
 */
abstract class Controller 
{
    protected function view($view, $data = [])
    {
        extract($data);
        require_once APP_ROOT . '/src/Views/' . $view . '.php';
    }

    protected function model($model)
    {
        require_once APP_ROOT . '/src/Models/' . $model . '.php';
        return new $model();
    }

    protected function redirect(string $url)
    {
        $redirect = APP_URL . $url;
        header("Location: {$redirect}");
    }
}