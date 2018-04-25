<?php

namespace Javier\Cineja\Domain\Model\Entity\Film;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Javier\Cineja\Infrastructure\Repository\Film\FilmGenreRepository")
 * @ORM\Table(name="film_genre")
 */
class FilmGenre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Infrastructure\Entity\Film\Film", inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Infrastructure\Entity\Film\Genre", inversedBy="genres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genre;

    public function __construct()
    {

    }

    public function id(): int
    {
        return $this->id;
    }

    public function film(): Film
    {
        return $this->film;
    }

    public function genre(): Genre
    {
        return $this->genre;
    }
}
