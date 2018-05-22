<?php

namespace Javier\Cineja\Application\Util\Role;

use Javier\Cineja\Domain\Model\JwtToken\Roles;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class RoleUser
{
    private $checkToken;

    public function __construct(CheckToken $checkToken)
    {
        $this->checkToken = $checkToken;
    }

    /**
     * @return mixed
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException
     */
    public function checkToken()
    {
        return $this->checkToken->execute($this->role());
    }

    private function role(): string
    {
        return Roles::ROLE_USER;
    }
}
