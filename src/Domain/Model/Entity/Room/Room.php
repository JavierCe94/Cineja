<?php

namespace Javier\Cineja\Domain\Model\Entity\Room;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Javier\Cineja\Infrastructure\Repository\Room\RoomRepository")
 * @ORM\Table(name="room")
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $totalSeatsByRow;

    /**
     * @ORM\Column(type="string", length=50, nullable=false, options={"default"="OPEN"})
     */
    private $stateRoom;

    public function __construct($name, $totalSeatsByRow)
    {
        $this->name = $name;
        $this->totalSeatsByRow = $totalSeatsByRow;
        $this->stateRoom = StateRoom::STATE_OPEN;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function totalSeatsByRow(): int
    {
        return $this->totalSeatsByRow;
    }

    public function stateRoom(): string
    {
        return $this->stateRoom;
    }

    public function setStateRoom(string $stateRoom): void
    {
        $this->stateRoom = $stateRoom;
    }
}
