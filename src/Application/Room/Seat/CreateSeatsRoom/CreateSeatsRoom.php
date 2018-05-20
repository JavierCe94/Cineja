<?php

namespace Javier\Cineja\Application\Room\Seat\CreateSeatsRoom;

use Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;

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
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($searchRoomById);
    }

    public function handle(CreateSeatsRoomCommand $createSeatsRoomCommand): array
    {
        $room = $this->searchRoomById->execute(
            $createSeatsRoomCommand->room()
        );
        if (ListExceptions::instance()->checkForExceptions()) {
            return ListExceptions::instance()->firstException();
        }
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
