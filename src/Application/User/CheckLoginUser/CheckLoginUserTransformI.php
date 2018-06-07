<?php

namespace Javier\Cineja\Application\User\CheckLoginUser;

interface CheckLoginUserTransformI
{
    public function transform(string $token, string $mail);
}
