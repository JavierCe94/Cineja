<?php

namespace Javier\Cineja\Domain\Service\PasswordHash;

class GeneratePasswordEncrypt
{
    public function execute(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
