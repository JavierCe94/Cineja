<?php

namespace Javier\Cineja\Infrastructure\Util\Role;

use Javier\Cineja\Domain\Model\JwtToken\Roles;

class RoleAdmin extends Role
{
    public function roles(): array
    {
        return [Roles::ROLE_ADMIN];
    }
}
