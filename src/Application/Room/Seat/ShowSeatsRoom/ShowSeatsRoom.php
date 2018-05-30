<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepository;

class ShowSeatsRoom
{
    private $seatRepository;
    private $showSeatsTransform;

    public function __construct(
        SeatRepository $seatRepository,
        ShowSeatsRoomTransformInterface $showSeatsTransform
    ) {
        $this->seatRepository = $seatRepository;
        $this->showSeatsTransform = $showSeatsTransform;
    }
    
    public function handle(ShowSeatsRoomCommand $showSeatsRoomCommand): array
    {
        return $this->showSeatsTransform->transform(
            $this->seatRepository->findSeatsByIdRoom(
                $showSeatsRoomCommand->room()
            )
        );
    }
}
