<?php

namespace Javier\Cineja\Application\Util\Role;

use Javier\Cineja\Domain\Model\JwtToken\Roles;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class RoleAdmin
{
    private $dataToken;

    public function __construct(CheckToken $checkToken)
    {
        $this->dataToken = $checkToken->execute(
            $this->role()
        );
    }

    public function dataToken()
    {
        return $this->dataToken;
    }

    private function role(): string
    {
        return Roles::ROLE_ADMIN;
    }
}
