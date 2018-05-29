<?php

namespace Javier\Cineja\Domain\Model\Entity\Admin;

interface AdminRepository
{
    public function findAdminByUsername(string $username): ?Admin;
}
