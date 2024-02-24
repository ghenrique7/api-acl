<?php

namespace App\DTO\User;

class EditUserDTO
{
    public function __construct(
        readonly public string $name,
        readonly public string $email,
        readonly public string $password
    )
    {

    }
}
