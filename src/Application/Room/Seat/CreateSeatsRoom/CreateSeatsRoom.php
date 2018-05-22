<?php

namespace Javier\Cineja\Application\Room\Seat\CreateSeatsRoom;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;

class CreateSeatsRoom extends RoleAdmin
{
    private $seatRepository;
    private $searchRoomById;

    public function __construct(
        SeatRepositoryInterface $seatRepository,
        SearchRoomById $searchRoomById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->seatRepository = $seatRepository;
        $this->searchRoomById = $searchRoomById;
    }

    /**
     * @param CreateSeatsRoomCommand $createSeatsRoomCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException
     */
    public function handle(CreateSeatsRoomCommand $createSeatsRoomCommand): array
    {
        $this->checkToken();
        $room = $this->searchRoomById->execute(
            $createSeatsRoomCommand->room()
        );
        $listSeats = [];
        for ($i = 0; $i < $createSeatsRoomCommand->totalSeatsRoom(); $i++) {
            $listSeats[] = new Seat(
                $room,
                $createSeatsRoomCommand->priceSeat()
            );
        }

        $this->seatRepository->createSeatsRoom($listSeats);

        return [
            'data' => 'Se han creado las butacas con éxito',
            'code' => HttpResponses::OK_CREATED
        ];
    }
}
