<?php

namespace Services;

use Models\User;

class AuthService
{
    public function login(string $email, string $password): bool
    {
        $user = User::findByEmail($email);
        if ($user && password_verify($password, $user->password)) {
            $this->authorize($user);
            return true;
        } else {
            return false;
        }
    }

    public function register(array $attributes): bool
    {
        $password = password_hash($attributes['password'], PASSWORD_BCRYPT);
        $user = User::create([
            'email' => $attributes['email'],
            'password' => $password
        ]);
        $this->authorize($user);
        return true;
    }

    public function authorize(User $user): void
    {
        $_SESSION['user_id'] = $user->id;
    }
    
}