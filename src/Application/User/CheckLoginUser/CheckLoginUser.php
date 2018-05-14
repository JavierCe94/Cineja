<?php

namespace Javier\Cineja\Application\User\CheckLoginUser;

use Javier\Cineja\Domain\Model\Entity\User\NotCorrectPasswordException;
use Javier\Cineja\Domain\Model\Entity\User\NotFoundUsersException;
use Javier\Cineja\Domain\Services\User\CheckPasswordEncrypt;
use Javier\Cineja\Domain\Services\User\SearchUserByMail;

class CheckLoginUser
{
    private $searchUserByMail;
    private $checkPasswordEncrypt;

    public function __construct(
        SearchUserByMail $searchUserByMail,
        CheckPasswordEncrypt $checkPasswordEncrypt
    ) {
        $this->searchUserByMail = $searchUserByMail;
        $this->checkPasswordEncrypt = $checkPasswordEncrypt;
    }

    public function handle(CheckLoginUserCommand $checkLoginUserCommand): array
    {
        try {
            $user = $this->searchUserByMail->execute(
                $checkLoginUserCommand->mail()
            );
        } catch (NotFoundUsersException $notFoundUsersException) {
            return ['ko' => $notFoundUsersException->getMessage()];
        }
        try {
            $this->checkPasswordEncrypt->execute(
                $checkLoginUserCommand->password(),
                $user->password()
            );
        } catch (NotCorrectPasswordException $notCorrectPasswordException) {
            return ['ko' => $notCorrectPasswordException->getMessage()];
        }

        return ['ok' => 200];
    }
}
