<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

interface JwtTokenClassInterface
{
    public function createToken(string $role, array $data): string;
    public function checkToken(string $role);
}
