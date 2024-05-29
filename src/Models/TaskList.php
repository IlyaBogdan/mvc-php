<?php

namespace Models;

use kernel\Model;
use Models\User;
use Models\Task;

/**
 * @property int $id
 * @property string $title
 * @property int $user_id
 * 
 * @property User $user
 * @property Task[] $tasks
 */
class TaskList extends Model
{

    public function tasks(): array
    {
        return $this->hasMany(Task::class, 'task_list_id', 'id');
    }
}