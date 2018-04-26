<?php

namespace Javier\Cineja\Domain\Model\Entity\Room;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Javier\Cineja\Infrastructure\Repository\Room\SectionRoomRepository")
 * @ORM\Table(name="section_room")
 */
class SectionRoom
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
    private $positionSection;

    public function __construct()
    {

    }

    public function id(): int
    {
        return $this->id;
    }

    public function positionSection(): string
    {
        return $this->positionSection;
    }
}
