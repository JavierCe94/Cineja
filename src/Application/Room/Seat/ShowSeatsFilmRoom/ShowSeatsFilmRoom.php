<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom;

use Javier\Cineja\Application\Util\Role\RoleUser;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepository;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;

class ShowSeatsFilmRoom extends RoleUser
{
    private $seatRepository;
    private $showSeatsFilmRoomTransform;

    public function __construct(
        SeatRepository $seatRepository,
        ShowSeatsFilmRoomTransformInterface $showSeatsFilmRoomTransform,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->seatRepository = $seatRepository;
        $this->showSeatsFilmRoomTransform = $showSeatsFilmRoomTransform;
    }
    
    public function handle(ShowSeatsFilmRoomCommand $showSeatsFilmRoomCommand): array
    {
        $seatsFilmRoom = $this->seatRepository->findSeatsFilmRoom(
            $showSeatsFilmRoomCommand->room(),
            $showSeatsFilmRoomCommand->filmRoom()
        );

        return $this->showSeatsFilmRoomTransform->transform($seatsFilmRoom);
    }
}
