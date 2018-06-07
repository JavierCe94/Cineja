<?php

namespace Javier\Cineja\Application\User\CheckLoginUser;

use Javier\Cineja\Domain\Model\JwtToken\Roles;
use Javier\Cineja\Domain\Service\PasswordHash\CheckPasswordEncrypt;
use Javier\Cineja\Domain\Service\User\SearchUserByMail;
use Javier\Cineja\Domain\Service\JwtToken\CreateToken;

class CheckLoginUser
{
    private $searchUserByMail;
    private $checkLoginUserTransform;
    private $checkPasswordEncrypt;
    private $createToken;

    public function __construct(
        SearchUserByMail $searchUserByMail,
        CheckLoginUserTransformI $checkLoginUserTransform,
        CheckPasswordEncrypt $checkPasswordEncrypt,
        CreateToken $createToken
    ) {
        $this->searchUserByMail = $searchUserByMail;
        $this->checkLoginUserTransform = $checkLoginUserTransform;
        $this->checkPasswordEncrypt = $checkPasswordEncrypt;
        $this->createToken = $createToken;
    }

    /**
     * @param CheckLoginUserCommand $checkLoginUserCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\Entity\User\NotFoundUsersException
     * @throws \Javier\Cineja\Domain\Model\PasswordHash\IncorrectPasswordException
     */
    public function handle(CheckLoginUserCommand $checkLoginUserCommand): array
    {
        $user = $this->searchUserByMail->execute(
            $checkLoginUserCommand->mail()
        );
        $this->checkPasswordEncrypt->execute(
            $checkLoginUserCommand->password(),
            $user->password()
        );

        return $this->checkLoginUserTransform->transform(
            $this->createToken->execute(
                Roles::ROLE_USER,
                [
                    'id' => $user->id(),
                    'mail' => $user->mail()
                ]
            ),
            $user->mail()
        );
    }
}
