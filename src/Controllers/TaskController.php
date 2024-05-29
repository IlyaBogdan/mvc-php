<?php

namespace Controllers;

use kernel\Controller;

class TaskController extends Controller
{

    public function index()
    {
        $this->view('login', ['title' => 'Main Page']);
    }

    public function createList()
    {

    }

    public function createTask()
    {

    }

    public function taskCompleted()
    {
        
    }
}