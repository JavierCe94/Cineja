<?php

namespace Javier\Cineja\Domain\Service\User;

use Javier\Cineja\Domain\Model\Entity\User\NotFoundUsersException;
use Javier\Cineja\Domain\Model\Entity\User\User;
use Javier\Cineja\Domain\Model\Entity\User\UserRepository;

class SearchUserById
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $id
     * @return User|null
     * @throws NotFoundUsersException
     */
    public function execute(int $id): User
    {
        $user = $this->userRepository->findUserById($id);
        if (null === $user) {
            throw new NotFoundUsersException();
        }

        return $user;
    }
}
