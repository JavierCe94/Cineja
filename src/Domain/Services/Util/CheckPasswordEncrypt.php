<?php

namespace Javier\Cineja\Domain\Services\Util;

use Javier\Cineja\Domain\Model\Entity\User\NotCorrectPasswordException;

class CheckPasswordEncrypt
{
    /**
     * @param string $password
     * @param string $passwordEncrypted
     * @throws NotCorrectPasswordException
     */
    public function execute(string $password, string $passwordEncrypted)
    {
        $isCorrectPassword = password_verify($password, $passwordEncrypted);
        if (false === $isCorrectPassword) {
            throw new NotCorrectPasswordException();
        }
    }
}
