<?php

namespace Javier\Cineja\Application\Room\Seat\CreateSeatsRoom;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;
use Javier\Cineja\Infrastructure\Repository\Room\Seat\SeatRepository;

class CreateSeatsRoom
{
    private $seatRepository;
    private $searchRoomById;

    public function __construct(
        SeatRepository $seatRepository,
        SearchRoomById $searchRoomById
    ) {
        $this->seatRepository = $seatRepository;
        $this->searchRoomById = $searchRoomById;
    }

    /**
     * @param CreateSeatsRoomCommand $createSeatsRoomCommand
     * @return array
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
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
