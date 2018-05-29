<?php

namespace Javier\Cineja\Domain\Service\PasswordHash;

use Javier\Cineja\Domain\Model\PasswordHash\IncorrectPasswordException;

class CheckPasswordEncrypt
{
    /**
     * @param string $password
     * @param string $passwordEncrypted
     * @throws IncorrectPasswordException
     */
    public function execute(string $password, string $passwordEncrypted): void
    {
        $isCorrectPassword = password_verify($password, $passwordEncrypted);
        if (false === $isCorrectPassword) {
            throw new IncorrectPasswordException();
        }
    }
}
