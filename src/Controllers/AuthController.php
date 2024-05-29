<?php

namespace Controllers;

use kernel\Controller;
use Models\User;

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
        $data = json_decode(file_get_contents('php://input'), true);
        $password = md5($data['password']);
        $user = User::create([
            'email' => $data['email'],
            'password' => $password
        ]);
    }
}