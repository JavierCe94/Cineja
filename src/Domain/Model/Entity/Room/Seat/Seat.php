<?php

namespace Javier\Cineja\Domain\Model\Entity\Room\Seat;

use Doctrine\ORM\Mapping as ORM;
use Javier\Cineja\Domain\Model\Entity\Room\Room;

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
     * @ORM\Column(type="float", nullable=false)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default"=false})
     */
    private $typeSpace;

    public function __construct($room, $price)
    {
        $this->room = $room;
        $this->price = $price;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function room(): Room
    {
        return $this->room;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function typeSpace(): ?bool
    {
        return $this->typeSpace;
    }
}
