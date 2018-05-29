<?php

namespace Javier\Cineja\Application\User\CreateUser;

use Javier\Cineja\Domain\Model\Entity\User\User;
use Javier\Cineja\Domain\Model\Entity\User\UserRepository;
use Javier\Cineja\Domain\Service\PasswordHash\GeneratePasswordEncrypt;

class CreateUser
{
    private $userRepository;
    private $createUserTransform;
    private $generatePasswordEncrypt;

    public function __construct(
        UserRepository $userRepository,
        CreateUserTransformInterface $createUserTransform,
        GeneratePasswordEncrypt $generatePasswordEncrypt
    ) {
        $this->userRepository = $userRepository;
        $this->createUserTransform = $createUserTransform;
        $this->generatePasswordEncrypt = $generatePasswordEncrypt;
    }

    public function handle(CreateUserCommand $createUserCommand): string
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

        return $this->createUserTransform->transform();
    }
}
