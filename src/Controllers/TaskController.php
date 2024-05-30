<?php

namespace Controllers;

use kernel\Controller;
use Models\User;
use Services\TaskService;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct()
    {
        $this->taskService = new TaskService();
    }

    public function index()
    {
        $user = User::find($_SESSION['user_id']);
        $this->view('main_page', ['title' => 'Main Page', 'lists' => $user->taskLists()]);
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