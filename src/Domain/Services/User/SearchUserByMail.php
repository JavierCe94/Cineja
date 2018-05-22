<?php

namespace Javier\Cineja\Domain\Services\User;

use Javier\Cineja\Domain\Model\Entity\User\NotFoundUsersException;
use Javier\Cineja\Domain\Model\Entity\User\User;
use Javier\Cineja\Domain\Model\Entity\User\UserRepositoryInterface;

class SearchUserByMail
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $mail
     * @return User|null
     * @throws NotFoundUsersException
     */
    public function execute(string $mail): User
    {
        $user = $this->userRepository->findUserByMail($mail);
        if (null === $user) {
            throw new NotFoundUsersException();
        }

        return $user;
    }
}
