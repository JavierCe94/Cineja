<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Javier\Cineja\Infrastructure\Repository\Film\GenreRepository")
 * @ORM\Table(name="genre")
 */
class Genre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false, unique=true)
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
