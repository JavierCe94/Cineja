<?php

namespace Javier\Cineja\Domain\Services\JwtToken;

use Javier\Cineja\Domain\Model\JwtToken\JwtTokenClassInterface;

class CreateToken
{
    private $jwtTokenClass;

    public function __construct(JwtTokenClassInterface $jwtTokenClass)
    {
        $this->jwtTokenClass = $jwtTokenClass;
    }

    public function execute(string $role, array $data): string
    {
        $token = $this->jwtTokenClass->createToken($role, $data);

        return $token;
    }
}
