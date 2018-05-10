<?php

namespace Javier\Cineja\Domain\Model\Entity\User;

interface UserRepositoryInterface
{
    public function createUser(User $user): User;
    public function findUserById(int $id): ?User;
    public function findUserByMail(string $mail): ?User;
}
