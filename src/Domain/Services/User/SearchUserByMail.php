<?php

namespace Javier\Cineja\Domain\Services\User;

use Javier\Cineja\Domain\Model\Entity\User\NotFoundUsersException;
use Javier\Cineja\Domain\Model\Entity\User\User;
use Javier\Cineja\Domain\Model\Entity\User\UserRepositoryInterface;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;
use Javier\Cineja\Domain\Services\Util\Observer\Observer;

class SearchUserByMail implements Observer
{
    private $stateException;
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->stateException = false;
        $this->userRepository = $userRepository;
    }

    public function execute(string $mail): User
    {
        $user = $this->userRepository->findUserByMail($mail);
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
