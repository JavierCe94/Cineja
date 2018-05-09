<?php

namespace Javier\Cineja\Application\User\CreateUser;

use Javier\Cineja\Domain\Model\Entity\User\User;
use Javier\Cineja\Domain\Services\User\GeneratePasswordEncrypt;
use Javier\Cineja\Infrastructure\Repository\User\UserRepository;

class CreateUser
{
    private $userRepository;
    private $generatePasswordEncrypt;

    public function __construct(
        UserRepository $userRepository,
        GeneratePasswordEncrypt $generatePasswordEncrypt
    ) {
        $this->userRepository = $userRepository;
        $this->generatePasswordEncrypt = $generatePasswordEncrypt;
    }

    /**
     * @param CreateUserCommand $createUserCommand
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(CreateUserCommand $createUserCommand): array
    {
        $password = $this->generatePasswordEncrypt->execute(
            $createUserCommand->password()
        );
        $user = new User(
            $createUserCommand->mail(),
            $createUserCommand->name(),
            $createUserCommand->surname(),
            $password,
            $createUserCommand->creditCard()
        );
        $this->userRepository->createUser($user);

        return ['ok' => 200];
    }
}
