<?php

namespace Javier\Cineja\Domain\Model\Entity\Admin;

interface AdminRepositoryInterface
{
    public function findAdminByUsername(string $username): ?Admin;
}
