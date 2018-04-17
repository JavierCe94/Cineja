<?php

namespace Javier\Cineja\Infrastructure\Entity\Film\Room;

use Doctrine\ORM\Mapping as ORM;
use Javier\Cineja\Infrastructure\Entity\Film\Film;

/**
 * @ORM\Entity
 * @ORM\Table(name="film_room")
 */
class FilmRoom
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
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Infrastructure\Entity\Film\Room\Room", inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $room;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $releaseDate;

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

    public function room(): Room
    {
        return $this->room;
    }

    public function releaseDate(): int
    {
        return $this->releaseDate;
    }
}
