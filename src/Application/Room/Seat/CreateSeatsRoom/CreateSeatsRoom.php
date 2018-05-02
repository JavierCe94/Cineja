<?php

namespace Javier\Cineja\Application\Room\Seat\CreateSeatsRoom;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Infrastructure\Repository\Room\RoomRepository;
use Javier\Cineja\Infrastructure\Repository\Room\Seat\SeatRepository;

class CreateSeatsRoom
{
    private $seatRepository;
    private $roomRepository;

    public function __construct(
        SeatRepository $seatRepository,
        RoomRepository $roomRepository
    ) {
        $this->seatRepository = $seatRepository;
        $this->roomRepository = $roomRepository;
    }

    /**
     * @param CreateSeatsRoomCommand $createSeatsRoomCommand
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(CreateSeatsRoomCommand $createSeatsRoomCommand): void
    {
        $room = $this->roomRepository->findByIdRoom(
            $createSeatsRoomCommand->idRoom()
        );

        $listSeats = [];
        for ($i = 0; $i < $createSeatsRoomCommand->totalSeatsRoom(); $i++) {
            $listSeats[] = new Seat(
                $room,
                $createSeatsRoomCommand->priceSeat()
            );
        }

        $this->seatRepository->createSeatsRoom($listSeats);
    }
}
