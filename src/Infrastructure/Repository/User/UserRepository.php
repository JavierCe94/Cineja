<?php

namespace Javier\Cineja\Infrastructure\Repository\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\User\User;
use Javier\Cineja\Domain\Model\Entity\User\UserRepository as UserRepositoryI;

class UserRepository extends ServiceEntityRepository implements UserRepositoryI
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

    /**
     * @param int $id
     * @return object|User
     */
    public function findUserById(int $id): ?User
    {
        return $this->find($id);
    }

    /**
     * @param string $mail
     * @return object|User
     */
    public function findUserByMail(string $mail): ?User
    {
        return $this->findOneBy(['mail' => $mail]);
    }

    /**
     * @param string $creditCard
     * @return object|User
     */
    public function findUserByCreditCard(string $creditCard): ?User
    {
        return $this->findOneBy(['creditCard' => $creditCard]);
    }
}
