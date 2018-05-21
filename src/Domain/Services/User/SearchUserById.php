<?php

namespace Javier\Cineja\Domain\Services\User;

use Javier\Cineja\Domain\Model\Entity\User\NotFoundUsersException;
use Javier\Cineja\Domain\Model\Entity\User\User;
use Javier\Cineja\Domain\Model\Entity\User\UserRepositoryInterface;
use Javier\Cineja\Domain\Util\Observer\ListExceptions;
use Javier\Cineja\Domain\Util\Observer\Observer;

class SearchUserById implements Observer
{
    private $stateException;
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->stateException = false;
        $this->userRepository = $userRepository;
    }

    public function execute(int $id): ?User
    {
        $user = $this->userRepository->findUserById($id);
        if (null === $user) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }

        return $user;
    }

    /**
     * @throws NotFoundUsersException
     */
    public function update()
    {
        if ($this->stateException) {
            throw new NotFoundUsersException();
        }
    }
}
