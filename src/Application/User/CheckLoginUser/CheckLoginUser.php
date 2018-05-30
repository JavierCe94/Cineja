<?php

namespace Javier\Cineja\Application\User\CheckLoginUser;

use Javier\Cineja\Domain\Model\JwtToken\Roles;
use Javier\Cineja\Domain\Service\PasswordHash\CheckPasswordEncrypt;
use Javier\Cineja\Domain\Service\User\SearchUserByMail;
use Javier\Cineja\Domain\Service\JwtToken\CreateToken;

class CheckLoginUser
{
    private $searchUserByMail;
    private $checkPasswordEncrypt;
    private $createToken;

    public function __construct(
        SearchUserByMail $searchUserByMail,
        CheckPasswordEncrypt $checkPasswordEncrypt,
        CreateToken $createToken
    ) {
        $this->searchUserByMail = $searchUserByMail;
        $this->checkPasswordEncrypt = $checkPasswordEncrypt;
        $this->createToken = $createToken;
    }

    /**
     * @param CheckLoginUserCommand $checkLoginUserCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\User\NotFoundUsersException
     * @throws \Javier\Cineja\Domain\Model\PasswordHash\IncorrectPasswordException
     */
    public function handle(CheckLoginUserCommand $checkLoginUserCommand): string
    {
        $user = $this->searchUserByMail->execute(
            $checkLoginUserCommand->mail()
        );
        $this->checkPasswordEncrypt->execute(
            $checkLoginUserCommand->password(),
            $user->password()
        );

        return $this->createToken->execute(
            Roles::ROLE_USER,
            [
                'id' => $user->id(),
                'mail' => $user->mail()
            ]
        );
    }
}
