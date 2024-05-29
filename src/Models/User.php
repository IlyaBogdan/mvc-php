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
    public static function findByEmail(string $email): User
    {
        global $db;
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new User($result);
    }

    public function taskLists(): array
    {
        return $this->hasMany(TaskList::class, 'user_id', 'id');
    }
}