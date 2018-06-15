<?php

namespace Javier\Cineja\Domain\Model\Entity\FilmRoom;

use Doctrine\ORM\Mapping as ORM;
use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Room\Room;

/**
 * @ORM\Entity(repositoryClass="Javier\Cineja\Infrastructure\Repository\FilmRoom\FilmRoomRepository")
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
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Domain\Model\Entity\Film\Film", inversedBy="filmRooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Domain\Model\Entity\Room\Room")
     * @ORM\JoinColumn(nullable=false)
     */
    private $room;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $releaseDate;

    public function __construct($film, $room, $releaseDate)
    {
        $this->film = $film;
        $this->room = $room;
        $this->releaseDate = $releaseDate;
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

    public function releaseDate(): \DateTime
    {
        return $this->releaseDate;
    }
}
