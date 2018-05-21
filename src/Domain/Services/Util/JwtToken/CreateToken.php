<?php

namespace Javier\Cineja\Domain\Services\Util\JwtToken;

use Javier\Cineja\Infrastructure\Util\JwtToken\JwtTokenUtil;

class CreateToken
{
    private $jwtTokenUtil;

    public function __construct(JwtTokenUtil $jwtTokenUtil)
    {
        $this->jwtTokenUtil = $jwtTokenUtil;
    }

    public function execute(string $role, array $data): string
    {
        $token = $this->jwtTokenUtil->createToken($role, $data);

        return $token;
    }
}
