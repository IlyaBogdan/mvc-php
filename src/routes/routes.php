<?php

use Controllers\AuthController;
use Controllers\TaskController;

return [
    '/login' => [
        'GET' => [AuthController::class, 'loginPage'],
        'POST' => [AuthController::class, 'loginAction']
    ],
    '/logout' => [
        'POST' => [AuthController::class, 'logout']
    ],
    '/register' => [
        'GET' => [AuthController::class, 'registerPage'],
        'POST' => [AuthController::class, 'registerAction']
    ],

    '/' => [
        'GET' => [TaskController::class, 'index']
    ],
    '/list' => [
        'POST' => [TaskController::class, 'createList']
    ],
    '/list/<id>/task' => [
        'POST' => [TaskController::class, 'createTask']
    ],
    '/list/<id>/task/<id>' => [
        'POST' => [TaskController::class, 'taskCompleted']
    ],
];