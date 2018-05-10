<?php

namespace Javier\Cineja\Infrastructure\Repository\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\User\User;
use Javier\Cineja\Domain\Model\Entity\User\UserRepositoryInterface;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     * @return User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createUser(User $user): User
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    public function findUserById(int $id): ?User
    {
        /* @var User $user */
        $user = $this->find($id);

        return $user;
    }

    public function findUserByMail(string $mail): ?User
    {
        /* @var User $user */
        $user = $this->findOneBy(['mail' => $mail]);

        return $user;
    }
}
