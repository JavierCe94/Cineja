<?php

namespace Javier\Cineja\Infrastructure\Entity\Film\Room\Seat;

use Doctrine\ORM\Mapping as ORM;
use Javier\Cineja\Infrastructure\Entity\Film\Room\Room;
use Javier\Cineja\Infrastructure\Entity\Film\Room\SectionRoom;

/**
 * @ORM\Entity(repositoryClass="Javier\Cineja\Infrastructure\Repository\Film\Room\Seat\SeatRepository")
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
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Infrastructure\Entity\Film\Room\Room", inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $room;

    /**
     * @ORM\ManyToOne(targetEntity="Javier\Cineja\Infrastructure\Entity\Film\Room\SectionRoom", inversedBy="section_rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sectionRoom;

    /**
     * @ORM\Column(type="decimal", nullable=false)
     */
    private $price;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $row;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $column;

    public function __construct()
    {

    }

    public function id(): int
    {
        return $this->id;
    }

    public function room(): Room
    {
        return $this->room;
    }

    public function sectionRoom(): SectionRoom
    {
        return $this->sectionRoom;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function row(): int
    {
        return $this->row;
    }

    public function column(): int
    {
        return $this->column;
    }
}
