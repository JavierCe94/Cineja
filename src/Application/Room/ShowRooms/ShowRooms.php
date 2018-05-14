<?php

namespace Javier\Cineja\Application\Room\ShowRooms;

use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;

class ShowRooms
{
    private $roomRepository;
    private $showRoomsTransform;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        ShowRoomsTransformInterface $showRoomsTransform
    ) {
        $this->roomRepository = $roomRepository;
        $this->showRoomsTransform = $showRoomsTransform;
    }

    public function handle(): array
    {
        $listRooms = $this->roomRepository->findRooms();
        if (0 === count($listRooms)) {
            return ['ko' => 'No se ha encontrado ninguna sala'];
        }

        return $this->showRoomsTransform
            ->transform($listRooms);
    }
}
