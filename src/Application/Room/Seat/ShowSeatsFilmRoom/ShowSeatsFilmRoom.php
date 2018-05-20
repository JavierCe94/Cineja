<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

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

        return [
            'data' => $this->showSeatsFilmRoomTransform->transform($seatsFilmRoom),
            'code' => HttpResponses::OK
        ];
    }
}
