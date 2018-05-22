<?php

namespace Javier\Cineja\Application\Admin\CheckLoginAdmin;

use Javier\Cineja\Domain\Model\Entity\Admin\AdminRepositoryInterface;
use Javier\Cineja\Domain\Model\Entity\Admin\NotFoundAdminsException;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Model\JwtToken\Roles;
use Javier\Cineja\Domain\Services\JwtToken\CreateToken;
use Javier\Cineja\Domain\Services\PasswordHash\CheckPasswordEncrypt;

class CheckLoginAdmin
{
    private $adminRepository;
    private $checkPasswordEncrypt;
    private $createToken;

    public function __construct(
        AdminRepositoryInterface $adminRepository,
        CheckPasswordEncrypt $checkPasswordEncrypt,
        CreateToken $createToken
    ) {
        $this->adminRepository = $adminRepository;
        $this->checkPasswordEncrypt = $checkPasswordEncrypt;
        $this->createToken = $createToken;
    }

    /**
     * @param CheckLoginAdminCommand $checkLoginAdminCommand
     * @return array
     * @throws NotFoundAdminsException
     * @throws \Javier\Cineja\Domain\Model\PasswordHash\IncorrectPasswordException
     */
    public function handle(CheckLoginAdminCommand $checkLoginAdminCommand): array
    {
        $admin = $this->adminRepository->findAdminByUsername(
            $checkLoginAdminCommand->username()
        );
        if (null === $admin) {
            throw new NotFoundAdminsException();
        }
        $this->checkPasswordEncrypt->execute(
            $checkLoginAdminCommand->password(),
            $admin->password()
        );
        $token = $this->createToken->execute(
            Roles::ROLE_ADMIN,
            [
                'username' => $checkLoginAdminCommand->username()
            ]
        );

        return [
            'data' => $token,
            'code' => HttpResponses::OK
        ];
    }
}
