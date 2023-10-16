<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
    function __construct(private Database $database)
    {
    }

    function isEmailTaken(string $email)
    {
        $emailCount =   $this->database->query("SELECT COUNT(*) from users WHERE email = :email", ['email' => $email])->count();

        if ($emailCount > 0) {
            throw new ValidationException(['Email' => 'Email Taken']);
        }
    }

    function addUser(array $data)
    {
        $password  = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        $this->database->query("INSERT into users (email,age,country,social_media_url,password) values
         (:email, :age, :country, :url, :password)", [
            'email' => $data['email'],
            'age' => $data['age'],
            'country' => $data['country'],
            'url' => $data['socialMedia'],
            'password' => $password
        ]);
    }
}
