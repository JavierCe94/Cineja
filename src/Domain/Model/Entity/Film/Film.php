<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Javier\Cineja\Infrastructure\Repository\Film\FilmRepository")
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
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $duration;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $minAge;

    /**
     * @ORM\Column(type="string", length=50, nullable=false, options={"default"="VISIBLE"})
     */
    private $stateFilm;

    public function __construct($image, $name, $description, $duration, $minAge)
    {
        $this->image = $image;
        $this->name = $name;
        $this->description = $description;
        $this->duration = $duration;
        $this->minAge = $minAge;
        $this->stateFilm = StateFilm::STATE_VISIBLE;
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

    public function duration(): int
    {
        return $this->duration;
    }

    public function minAge(): int
    {
        return $this->minAge;
    }

    public function stateFilm(): string
    {
        return $this->stateFilm;
    }

    public function setStateFilm(string $stateFilm): void
    {
        $this->stateFilm = $stateFilm;
    }
}
