<?php

namespace Javier\Cineja\Domain\Services\JwtToken;

use Javier\Cineja\Infrastructure\JwtToken\JwtTokenClass;

class CheckToken
{
    private $jwtTokenClass;

    public function __construct(JwtTokenClass $jwtTokenClass)
    {
        $this->jwtTokenClass = $jwtTokenClass;
    }

    /**
     * @param string $role
     * @return mixed
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException
     */
    public function execute(string $role)
    {
        $data = $this->jwtTokenClass->checkToken($role);

        return $data;
    }
}
