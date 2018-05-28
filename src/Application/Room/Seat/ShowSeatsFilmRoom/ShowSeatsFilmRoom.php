<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom;

use Javier\Cineja\Application\Util\Role\RoleUser;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class ShowSeatsFilmRoom extends RoleUser
{
    private $seatRepository;
    private $showSeatsFilmRoomTransform;

    public function __construct(
        SeatRepositoryInterface $seatRepository,
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

        return [
            'data' => $this->showSeatsFilmRoomTransform->transform($seatsFilmRoom),
            'code' => HttpResponses::OK
        ];
    }
}
