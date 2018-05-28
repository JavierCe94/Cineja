<?php

namespace Javier\Cineja\Application\Room\Seat\ShowSeatsRoom;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class ShowSeatsRoom extends RoleAdmin
{
    private $seatRepository;
    private $showSeatsTransform;

    public function __construct(
        SeatRepositoryInterface $seatRepository,
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

        return [
            'data' => $this->showSeatsTransform->transform($seats),
            'code' => HttpResponses::OK
        ];
    }
}
