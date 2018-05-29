<?php

namespace Javier\Cineja\Application\Util\Role;

use Javier\Cineja\Domain\Service\JwtToken\CheckToken;

abstract class Role
{
    private $dataToken;

    public function __construct(CheckToken $checkToken)
    {
        $this->dataToken = $checkToken->execute(
            $this->roles()
        );
    }

    public function dataToken()
    {
        return $this->dataToken;
    }

    public abstract function roles(): array;
}
