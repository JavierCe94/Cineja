<?php

namespace Javier\Cineja\Application\User\CheckLoginUser;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Model\JwtToken\Roles;
use Javier\Cineja\Domain\Services\Util\CheckPasswordEncrypt;
use Javier\Cineja\Domain\Services\User\SearchUserByMail;
use Javier\Cineja\Domain\Services\Util\JwtToken\CreateToken;
use Javier\Cineja\Domain\Util\Observer\ListExceptions;

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
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($searchUserByMail);
        ListExceptions::instance()->attach($checkPasswordEncrypt);
    }

    public function handle(CheckLoginUserCommand $checkLoginUserCommand): array
    {
        $user = $this->searchUserByMail->execute(
            $checkLoginUserCommand->mail()
        );
        $this->checkPasswordEncrypt->execute(
            $checkLoginUserCommand->password(),
            null !== $user ? $user->password() : ''
        );
        if (ListExceptions::instance()->checkForExceptions()) {
            return ListExceptions::instance()->firstException();
        }
        $token = $this->createToken->execute(
            Roles::ROLE_USER,
            [
                'id' => $user->id(),
                'mail' => $user->mail()
            ]
        );

        return [
            'data' => $token,
            'code' => HttpResponses::OK
        ];
    }
}
