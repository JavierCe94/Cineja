<?php

namespace Javier\Cineja\Application\Admin\CheckLoginAdmin;

class CheckLoginAdminTransform implements CheckLoginAdminTransformI
{
    public function transform(string $token, string $userName)
    {
        return [
            'token' => $token,
            'userName' => $userName
        ];
    }
}
