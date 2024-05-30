<?php

namespace Controllers;

use kernel\Controller;
use Models\Task;
use Models\TaskList;
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
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $taskList = TaskList::create($data);
        
        echo json_encode(array_merge(
            $taskList->__serialize(),
            ['tasks' => []]
        ));
    }

    public function createTask()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $task = Task::create($data);
        
        echo json_encode($task->__serialize());
    }

    public function taskCompleted(int $listId, int $taskId)
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $task = Task::find($taskId);
        $task->completed = $data['completed'];
        $task->save();

        echo json_encode($task->__serialize());
    }
}