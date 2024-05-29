<?php

namespace Controllers;

use kernel\Controller;
use Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function loginPage()
    {
        $this->view('login', ['title' => 'Login']);
    }

    /**
     * Action for users login
     * Method: POST
     * Body: { email: string, password: string }
     */
    public function loginAction()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if ($this->authService->login($data['email'], $data['password']))
            echo json_encode(['status' => 'success', 'redirect' => '/']);
        else 
            echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
        
    }

    public function logout()
    {
        session_destroy();
        echo json_encode(['status' => 'success', 'redirect' => '/login']);
    }

    public function registerPage()
    {
        $this->view('register', ['title' => 'Register']);
    }

    /**
     * Action for users registration
     * Method: POST
     * Body: { email: string, password: string }
     */
    public function registerAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if ($this->authService->register($data))
            echo json_encode(['status' => 'success', 'redirect' => '/']);
    }
}