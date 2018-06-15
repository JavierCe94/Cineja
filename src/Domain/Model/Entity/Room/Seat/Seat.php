<?php

namespace Javier\Cineja\Domain\Model\Entity\Room\Seat;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Javier\Cineja\Domain\Model\Entity\Room\Room;
use Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilm;

/**
 * @ORM\Entity(repositoryClass="Javier\Cineja\Infrastructure\Repository\Room\Seat\SeatRepository")
 * @ORM\Table(name="seat")
 */
class Seat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Domain\Model\Entity\Room\Room", inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $room;

    /**
     * @ORM\OneToMany(targetEntity="Javier\Cineja\Domain\Model\Entity\UserSeatFilm\UserSeatFilm", mappedBy="seat")
     */
    private $userSeatFilm;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $typeSpace;

    public function __construct($room, $price)
    {
        $this->room = $room;
        $this->price = $price;
        $this->typeSpace = false;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function room(): Room
    {
        return $this->room;
    }

    /**
     * @return Collection|UserSeatFilm[]
     */
    public function userSeatFilm(): Collection
    {
        return $this->userSeatFilm;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function typeSpace(): bool
    {
        return $this->typeSpace;
    }

    public function setTypeSpace(bool $typeSpace): void
    {
        $this->typeSpace = $typeSpace;
    }
}
