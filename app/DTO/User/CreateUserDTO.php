<?php

namespace App\DTO\User;

class CreateUserDTO
{
    public function __construct(
        readonly public string $name,
        readonly public string $email,
        readonly public string $password
    )
    {

    }
}
