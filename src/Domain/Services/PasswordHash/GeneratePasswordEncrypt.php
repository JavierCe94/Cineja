<?php

namespace Javier\Cineja\Domain\Services\PasswordHash;

class GeneratePasswordEncrypt
{
    public function execute(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
