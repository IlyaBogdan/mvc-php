<?php

namespace Controllers;

use kernel\Controller;

class AuthController extends Controller
{

    public function loginPage()
    {
        $this->view('login', ['title' => 'Login']);
    }
    public function loginAction()
    {
        
    }

    public function logout()
    {

    }

    public function registerPage()
    {
        $this->view('register', ['title' => 'Register']);
    }

    public function registerAction()
    {
        echo(json_encode(['redirect' => '/']));
    }
}