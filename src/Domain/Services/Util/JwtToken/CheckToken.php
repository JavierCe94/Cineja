<?php

namespace Javier\Cineja\Domain\Services\Util\JwtToken;

use Javier\Cineja\Infrastructure\Util\JwtToken\JwtTokenUtil;

class CheckToken
{
    private $statusInvalidToken;
    private $statusInvalidUserToken;
    private $jwtTokenUtil;

    public function __construct(JwtTokenUtil $jwtTokenUtil)
    {
        $this->statusInvalidToken = false;
        $this->statusInvalidUserToken = false;
        $this->jwtTokenUtil = $jwtTokenUtil;
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
        $data = $this->jwtTokenUtil->checkToken($role);

        return $data;
    }
}
