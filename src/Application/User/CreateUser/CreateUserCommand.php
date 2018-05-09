<?php

namespace Javier\Cineja\Application\User\CreateUser;

class CreateUserCommand
{
    private $mail;
    private $name;
    private $surname;
    private $password;
    private $creditCard;

    public function __construct($mail, $name, $surname, $password, $creditCard)
    {
        $this->mail = $mail;
        $this->name = $name;
        $this->surname = $surname;
        $this->password = $password;
        $this->creditCard = $creditCard;
    }

    public function mail(): string
    {
        return $this->mail;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function surname(): string
    {
        return $this->surname;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function creditCard(): string
    {
        return $this->creditCard;
    }
}
