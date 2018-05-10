<?php

namespace Javier\Cineja\Application\User\LoginUser;

use Javier\Cineja\Domain\Model\Entity\User\NotCorrectPasswordException;
use Javier\Cineja\Domain\Model\Entity\User\UserRepositoryInterface;
use Javier\Cineja\Domain\Services\User\CheckPasswordEncrypt;

class LoginUser
{
    private $userRepository;
    private $checkPasswordEncrypt;

    public function __construct(
        UserRepositoryInterface $userRepository,
        CheckPasswordEncrypt $checkPasswordEncrypt
    ) {
        $this->userRepository = $userRepository;
        $this->checkPasswordEncrypt = $checkPasswordEncrypt;
    }

    public function handle(LoginUserCommand $loginUserCommand): array
    {
        $user = $this->userRepository->findUserByMail(
            $loginUserCommand->mail()
        );
        if (null === $user) {
            return ['ko' => 'No se ha encontrado el correo electrónico introducido'];
        }
        try {
            $this->checkPasswordEncrypt->execute(
                $loginUserCommand->password(),
                $user->password()
            );
        } catch (NotCorrectPasswordException $notCorrectPasswordException) {
            return ['ko' => $notCorrectPasswordException->getMessage()];
        }

        return ['ok' => 200];
    }
}
