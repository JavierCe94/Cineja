<?php

namespace Javier\Cineja\Application\User\CreateUser;

use Javier\Cineja\Domain\Model\Entity\User\User;
use Javier\Cineja\Domain\Model\Entity\User\UserRepositoryInterface;
use Javier\Cineja\Domain\Services\User\GeneratePasswordEncrypt;

class CreateUser
{
    private $userRepository;
    private $generatePasswordEncrypt;

    public function __construct(
        UserRepositoryInterface $userRepository,
        GeneratePasswordEncrypt $generatePasswordEncrypt
    ) {
        $this->userRepository = $userRepository;
        $this->generatePasswordEncrypt = $generatePasswordEncrypt;
    }

    /**
     * @param CreateUserCommand $createUserCommand
     * @return array
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
