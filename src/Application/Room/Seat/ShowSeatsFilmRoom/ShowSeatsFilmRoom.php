<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;

class ShowSeatsFilmRoom
{
    private $seatRepository;
    private $showSeatsFilmRoomTransform;

    public function __construct(
        SeatRepositoryInterface $seatRepository,
        ShowSeatsFilmRoomTransformInterface $showSeatsFilmRoomTransform
    ) {
        $this->seatRepository = $seatRepository;
        $this->showSeatsFilmRoomTransform = $showSeatsFilmRoomTransform;
    }

    public function handle(ShowSeatsFilmRoomCommand $showSeatsFilmRoomCommand): array
    {
        $seatsFilmRoom = $this->seatRepository->findSeatsFilmRoom(
            $showSeatsFilmRoomCommand->room(),
            $showSeatsFilmRoomCommand->filmRoom()
        );

        return $this->showSeatsFilmRoomTransform
            ->transform($seatsFilmRoom);
    }
}
