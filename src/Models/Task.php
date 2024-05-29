<?php

namespace Models;

use kernel\Model;
use Models\TaskList;

/**
 * @property int $id
 * @property string $title
 * @property int $task_list_id
 * @property bool $completed
 * 
 * @property TaskList $list
 */
class Task extends Model
{
    public function list(): TaskList
    {
        return $this->hasOne(TaskList::class, 'id', 'task_list_id');
    }
}