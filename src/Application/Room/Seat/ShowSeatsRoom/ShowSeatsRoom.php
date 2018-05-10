<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;

class ShowSeatsRoom
{
    private $seatRepository;
    private $showSeatsTransform;

    public function __construct(
        SeatRepositoryInterface $seatRepository,
        ShowSeatsRoomTransformInterface $showSeatsTransform
    ) {
        $this->seatRepository = $seatRepository;
        $this->showSeatsTransform = $showSeatsTransform;
    }

    public function handle(ShowSeatsRoomCommand $showSeatsRoomCommand): array
    {
        $seats = $this->seatRepository->findSeatsByIdRoom(
            $showSeatsRoomCommand->room()
        );
        if (0 === count($seats)) {
            return ['ko' => 'No se ha encontrado ningún asiento'];
        }

        return $this->showSeatsTransform
            ->transform($seats);
    }
}
