<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepository;

class ShowSeatsFilmRoom
{
    private $seatRepository;
    private $showSeatsFilmRoomTransform;

    public function __construct(
        SeatRepository $seatRepository,
        ShowSeatsFilmRoomTransformI $showSeatsFilmRoomTransform
    ) {
        $this->seatRepository = $seatRepository;
        $this->showSeatsFilmRoomTransform = $showSeatsFilmRoomTransform;
    }

    public function handle(ShowSeatsFilmRoomCommand $showSeatsFilmRoomCommand): array
    {
        return $this->showSeatsFilmRoomTransform->transform(
            $this->seatRepository->findSeatsByIdRoom(
                $showSeatsFilmRoomCommand->room()
            ),
            $showSeatsFilmRoomCommand->filmRoom()
        );
    }
}
