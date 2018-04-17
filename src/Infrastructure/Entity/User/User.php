<?php

namespace Javier\Cineja\Infrastructure\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, nullable=false, unique=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=75, nullable=false)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=16, nullable=false, unique=true)
     */
    private $creditCard;

    public function __construct()
    {

    }

    public function id(): int
    {
        return $this->id;
    }

    public function mail(): string
    {
        return $this->mail;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function surname(): string
    {
        return $this->surname;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function creditCard(): string
    {
        return $this->creditCard;
    }
}
