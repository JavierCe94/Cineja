<?php

namespace Javier\Cineja\Domain\Model\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Javier\Cineja\Infrastructure\Repository\Admin\AdminRepository")
 * @ORM\Table(name="admin")
 */
class Admin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=70, nullable=false)
     */
    private $password;

    public function id(): int
    {
        return $this->id;
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function password(): string
    {
        return $this->password;
    }
}
