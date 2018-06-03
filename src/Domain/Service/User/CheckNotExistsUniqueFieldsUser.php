<?php

namespace Javier\Cineja\Domain\Service\User;

use Javier\Cineja\Domain\Model\Entity\User\FoundCreditCardUserException;
use Javier\Cineja\Domain\Model\Entity\User\FoundMailUserException;
use Javier\Cineja\Domain\Model\Entity\User\UserRepository;

class CheckNotExistsUniqueFieldsUser
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $mail
     * @param string $creditCard
     * @throws FoundCreditCardUserException
     * @throws FoundMailUserException
     */
    public function execute(string $mail, string $creditCard): void
    {
        $userMail = $this->userRepository->findUserByMail($mail);
        if (null !== $userMail) {
            throw new FoundMailUserException();
        }
        $userCreditCard = $this->userRepository->findUserByCreditCard($creditCard);
        if (null !== $userCreditCard) {
            throw new FoundCreditCardUserException();
        }
    }
}
