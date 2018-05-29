<?php

namespace Javier\Cineja\Infrastructure\Repository\Admin;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Admin\Admin;
use Javier\Cineja\Domain\Model\Entity\Admin\AdminRepository as AdminRepositoryInterface;

class AdminRepository extends ServiceEntityRepository implements AdminRepositoryInterface
{
    public function findAdminByUsername(string $username): ?Admin
    {
        /* @var Admin $admin */
        $admin = $this->findOneBy(['userName' => $username]);

        return $admin;
    }
}
