<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsRoom;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepository;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;

class ShowSeatsRoom extends RoleAdmin
{
    private $seatRepository;
    private $showSeatsTransform;

    public function __construct(
        SeatRepository $seatRepository,
        ShowSeatsRoomTransformInterface $showSeatsTransform,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->seatRepository = $seatRepository;
        $this->showSeatsTransform = $showSeatsTransform;
    }
    
    public function handle(ShowSeatsRoomCommand $showSeatsRoomCommand): array
    {
        $seats = $this->seatRepository->findSeatsByIdRoom(
            $showSeatsRoomCommand->room()
        );

        return $this->showSeatsTransform->transform($seats);
    }
}
