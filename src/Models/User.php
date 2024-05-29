<?php

namespace Models;

use Models\TaskList;

use kernel\Model;

/**
 * @property int $id
 * @property string $email
 * @property string $password
 * 
 * @property TaskList[] $taskLists
 */
class User extends Model
{
    public function taskLists(): array
    {
        return $this->hasMany(TaskList::class, 'user_id', 'id');
    }
}