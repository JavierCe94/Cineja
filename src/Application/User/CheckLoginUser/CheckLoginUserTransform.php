<?php

namespace Javier\Cineja\Application\User\CheckLoginUser;

class CheckLoginUserTransform implements CheckLoginUserTransformI
{
    public function transform(string $token, string $mail)
    {
        return [
            'token' => $token,
            'userName' => $mail
        ];
    }
}
