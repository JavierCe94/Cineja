<?php

namespace Javier\Cineja\Domain\Services\Util;

use Javier\Cineja\Domain\Model\Entity\User\NotCorrectPasswordException;
use Javier\Cineja\Domain\Util\Observer\ListExceptions;
use Javier\Cineja\Domain\Util\Observer\Observer;

class CheckPasswordEncrypt implements Observer
{
    private $stateException;

    public function __construct()
    {
        $this->stateException = false;
    }

    public function execute(string $password, string $passwordEncrypted)
    {
        $isCorrectPassword = password_verify($password, $passwordEncrypted);
        if (false === $isCorrectPassword) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }
    }

    /**
     * @throws NotCorrectPasswordException
     */
    public function update()
    {
        if ($this->stateException) {
            throw new NotCorrectPasswordException();
        }
    }
}
