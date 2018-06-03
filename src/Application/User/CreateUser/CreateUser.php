<?php

namespace Javier\Cineja\Application\User\CreateUser;

use Javier\Cineja\Domain\Model\Entity\User\User;
use Javier\Cineja\Domain\Model\Entity\User\UserRepository;
use Javier\Cineja\Domain\Service\PasswordHash\GeneratePasswordEncrypt;
use Javier\Cineja\Domain\Service\User\CheckNotExistsUniqueFieldsUser;

class CreateUser
{
    private $userRepository;
    private $createUserTransform;
    private $checkNotExistsUniqueFieldsUser;
    private $generatePasswordEncrypt;

    public function __construct(
        UserRepository $userRepository,
        CreateUserTransformI $createUserTransform,
        CheckNotExistsUniqueFieldsUser $checkNotExistsUniqueFieldsUser,
        GeneratePasswordEncrypt $generatePasswordEncrypt
    ) {
        $this->userRepository = $userRepository;
        $this->createUserTransform = $createUserTransform;
        $this->checkNotExistsUniqueFieldsUser = $checkNotExistsUniqueFieldsUser;
        $this->generatePasswordEncrypt = $generatePasswordEncrypt;
    }

    /**
     * @param CreateUserCommand $createUserCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\User\FoundCreditCardUserException
     * @throws \Javier\Cineja\Domain\Model\Entity\User\FoundMailUserException
     */
    public function handle(CreateUserCommand $createUserCommand): string
    {
        $this->checkNotExistsUniqueFieldsUser->execute(
            $createUserCommand->mail(),
            $createUserCommand->creditCard()
        );
        $this->userRepository->createUser(
            new User(
                $createUserCommand->mail(),
                $createUserCommand->name(),
                $createUserCommand->surname(),
                $this->generatePasswordEncrypt->execute(
                    $createUserCommand->password()
                ),
                $createUserCommand->creditCard()
            )
        );

        return $this->createUserTransform->transform();
    }
}
