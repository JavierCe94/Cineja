<?php

namespace Javier\Cineja\Application\User\LoginUser;

class LoginUserCommand
{
    private $mail;
    private $password;

    public function __construct($mail, $password)
    {
        $this->mail = $mail;
        $this->password = $password;
    }

    public function mail(): string
    {
        return $this->mail;
    }

    public function password(): string
    {
        return $this->password;
    }
}
