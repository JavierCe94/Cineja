<?php

namespace Javier\Cineja\Domain\Model\Entity\Film\Room\Seat;

use Doctrine\ORM\Mapping as ORM;
use Javier\Cineja\Infrastructure\Entity\Film\Film;
use Javier\Cineja\Infrastructure\Entity\User\User;

/**
 * @ORM\Entity(repositoryClass="Javier\Cineja\Infrastructure\Repository\Film\Room\Seat\SeatFilmRepository")
 * @ORM\Table(name="seat_film")
 */
class SeatFilm
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Infrastructure\Entity\Film\Room\Seat\Seat", inversedBy="seats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $seat;

    /**
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Infrastructure\Entity\Film\Film", inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Infrastructure\Entity\User\User", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=50, nullable=false, unique=true, options={"default"="None"})
     */
    private $codeQr;

    public function __construct()
    {

    }

    public function id(): int
    {
        return $this->id;
    }

    public function seat(): Seat
    {
        return $this->seat;
    }

    public function film(): Film
    {
        return $this->film;
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
