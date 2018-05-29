<?php

namespace Javier\Cineja\Application\Util\Role;

use Javier\Cineja\Domain\Model\JwtToken\Roles;

class RoleUser extends Role
{
    public function roles(): array
    {
        return [Roles::ROLE_USER];
    }
}
