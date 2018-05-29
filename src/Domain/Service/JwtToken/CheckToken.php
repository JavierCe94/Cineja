<?php

namespace Javier\Cineja\Domain\Service\JwtToken;

use Javier\Cineja\Domain\Model\JwtToken\JwtTokenClass;

class CheckToken
{
    private $jwtTokenClass;

    public function __construct(JwtTokenClass $jwtTokenClass)
    {
        $this->jwtTokenClass = $jwtTokenClass;
    }
    
    public function execute(array $roles)
    {
        $data = $this->jwtTokenClass->checkToken($roles);

        return $data;
    }
}
