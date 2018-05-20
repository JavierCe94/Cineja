<?php

namespace Javier\Cineja\Application\User\CheckLoginUser;

use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Util\CheckPasswordEncrypt;
use Javier\Cineja\Domain\Services\User\SearchUserByMail;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;

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
            $user->password()
        );
        if (ListExceptions::instance()->checkForExceptions()) {
            return ListExceptions::instance()->firstException();
        }

        return [
            'data' => 'Los datos introducidos son correctos',
            'code' => HttpResponses::OK
        ];
    }
}
