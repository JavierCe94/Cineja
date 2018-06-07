<?php

namespace Javier\Cineja\Application\Admin\CheckLoginAdmin;

interface CheckLoginAdminTransformI
{
    public function transform(string $token, string $userName);
}
