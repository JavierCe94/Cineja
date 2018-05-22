<?php

namespace Javier\Cineja\Domain\Services\JwtToken;

use Javier\Cineja\Infrastructure\JwtToken\JwtTokenClass;

class CreateToken
{
    private $jwtTokenClass;

    public function __construct(JwtTokenClass $jwtTokenClass)
    {
        $this->jwtTokenClass = $jwtTokenClass;
    }

    public function execute(string $role, array $data): string
    {
        $token = $this->jwtTokenClass->createToken($role, $data);

        return $token;
    }
}
