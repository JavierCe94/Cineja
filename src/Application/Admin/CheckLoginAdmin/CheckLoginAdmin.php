<?php

namespace Javier\Cineja\Application\Admin\CheckLoginAdmin;

use Javier\Cineja\Domain\Model\Entity\Admin\AdminRepository;
use Javier\Cineja\Domain\Model\Entity\Admin\NotFoundAdminsException;
use Javier\Cineja\Domain\Model\JwtToken\Roles;
use Javier\Cineja\Domain\Service\JwtToken\CreateToken;
use Javier\Cineja\Domain\Service\PasswordHash\CheckPasswordEncrypt;

class CheckLoginAdmin
{
    private $adminRepository;
    private $checkPasswordEncrypt;
    private $createToken;

    public function __construct(
        AdminRepository $adminRepository,
        CheckPasswordEncrypt $checkPasswordEncrypt,
        CreateToken $createToken
    ) {
        $this->adminRepository = $adminRepository;
        $this->checkPasswordEncrypt = $checkPasswordEncrypt;
        $this->createToken = $createToken;
    }

    /**
     * @param CheckLoginAdminCommand $checkLoginAdminCommand
     * @return string
     * @throws NotFoundAdminsException
     * @throws \Javier\Cineja\Domain\Model\PasswordHash\IncorrectPasswordException
     */
    public function handle(CheckLoginAdminCommand $checkLoginAdminCommand): string
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

        return $this->createToken->execute(
            Roles::ROLE_ADMIN,
            [
                'username' => $admin->username()
            ]
        );
    }
}
