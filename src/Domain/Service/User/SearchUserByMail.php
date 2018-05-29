<?php

namespace Javier\Cineja\Domain\Service\User;

use Javier\Cineja\Domain\Model\Entity\User\NotFoundUsersException;
use Javier\Cineja\Domain\Model\Entity\User\User;
use Javier\Cineja\Domain\Model\Entity\User\UserRepository;

class SearchUserByMail
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $mail
     * @return User
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
