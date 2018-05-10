<?php

namespace Javier\Cineja\Domain\Model\Entity\UserSeatFilm;

use Doctrine\ORM\Mapping as ORM;
use Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Domain\Model\Entity\User\User;

/**
 * @ORM\Entity(repositoryClass="Javier\Cineja\Infrastructure\Repository\UserSeatFilm\UserSeatFilmRepository")
 * @ORM\Table(name="user_seat_film")
 */
class UserSeatFilm
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat", inversedBy="userSeatsFilm")
     * @ORM\JoinColumn(nullable=false)
     */
    private $seat;

    /**
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Domain\Model\Entity\FilmRoom\FilmRoom", inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $filmRoom;

    /**
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Domain\Model\Entity\User\User", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=20, nullable=false, unique=true)
     */
    private $codeQr;

    public function __construct($seat, $filmRoom, $user, $codeQr)
    {
        $this->seat = $seat;
        $this->filmRoom = $filmRoom;
        $this->user = $user;
        $this->codeQr = $codeQr;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function seat(): Seat
    {
        return $this->seat;
    }

    public function filmRoom(): FilmRoom
    {
        return $this->filmRoom;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function codeQr(): string
    {
        return $this->codeQr;
    }
}
