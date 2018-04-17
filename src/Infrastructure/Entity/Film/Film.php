<?php

namespace Javier\Cineja\Infrastructure\Entity\Film;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Javier\Cineja\Infrastructure\Repository\FilmRepository")
 * @ORM\Table(name="film")
 */
class Film
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75, nullable=false)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=60, nullable=false, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $minDescription;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $duration;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $minAge;

    public function __construct()
    {

    }

    public function id(): int
    {
        return $this->id;
    }

    public function image(): string
    {
        return $this->image;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function minDescription(): string
    {
        return $this->minDescription;
    }

    public function duration(): int
    {
        return $this->duration;
    }

    public function minAge(): int
    {
        return $this->minAge;
    }
}
