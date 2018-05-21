<?php

namespace Javier\Cineja\Domain\Model\Admin;

class Admin
{
    private $userName;
    private $password;

    public function __construct()
    {
        $this->userName = 'Javier';
        $this->password = '1234';
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function password(): string
    {
        return $this->password;
    }
}
