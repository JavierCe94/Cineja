<?php

namespace Javier\Cineja\Application\Room\Seat\CreateSeatsRoom;

use Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;

class CreateSeatsRoom
{
    private $seatRepository;
    private $searchRoomById;

    public function __construct(
        SeatRepositoryInterface $seatRepository,
        SearchRoomById $searchRoomById
    ) {
        $this->seatRepository = $seatRepository;
        $this->searchRoomById = $searchRoomById;
    }

    /**
     * @param CreateSeatsRoomCommand $createSeatsRoomCommand
     * @return array
     */
    public function handle(CreateSeatsRoomCommand $createSeatsRoomCommand): array
    {
        try {
            $room = $this->searchRoomById->execute(
                $createSeatsRoomCommand->idRoom()
            );
        } catch (NotFoundRoomsException $notFoundRoomsException) {
            return ['ko' => $notFoundRoomsException->getMessage()];
        }
        $listSeats = [];
        for ($i = 0; $i < $createSeatsRoomCommand->totalSeatsRoom(); $i++) {
            $listSeats[] = new Seat(
                $room,
                $createSeatsRoomCommand->priceSeat()
            );
        }

        $this->seatRepository->createSeatsRoom($listSeats);

        return ['ok' => 200];
    }
}
