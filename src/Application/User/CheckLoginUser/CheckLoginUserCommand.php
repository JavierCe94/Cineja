<?php

namespace Javier\Cineja\Application\User\CheckLoginUser;

class CheckLoginUserCommand
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
