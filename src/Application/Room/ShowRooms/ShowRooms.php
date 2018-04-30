<?php

namespace Javier\Cineja\Application\Room\ShowRooms;

use Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException;
use Javier\Cineja\Infrastructure\Repository\Room\RoomRepository;

class ShowRooms
{
    private $roomRepository;
    private $showRoomsTransform;

    public function __construct(RoomRepository $roomRepository, ShowRoomsTransformInterface $showRoomsTransform)
    {
        $this->roomRepository = $roomRepository;
        $this->showRoomsTransform = $showRoomsTransform;
    }

    /**
     * @return array
     * @throws NotFoundRoomsException
     */
    public function handle(): array
    {
        $listRooms = $this->roomRepository->showRooms();

        if (0 === count($listRooms)) {
            throw new NotFoundRoomsException('No se han encontrado salas');
        }

        return $this->showRoomsTransform
            ->transform($listRooms);
    }
}
