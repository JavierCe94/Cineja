<?php

namespace Javier\Cineja\Domain\Model\JwtToken;

class JwtToken
{
    const KEY = '2$f9gE2f9f9L';
    const TYPE_ENCRYPT = ['HS256'];
    const ONE_HOUR = 3600;
    const ONE_DAY = 3600*24;
    const ONE_WEEK = (3600*24)*7;
}
