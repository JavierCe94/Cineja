<?php

namespace Javier\Cineja\Application\Room\ShowRooms;

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
     */
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
