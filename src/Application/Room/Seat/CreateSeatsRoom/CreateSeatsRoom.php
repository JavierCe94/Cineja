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
     * @param CreateSeatsRoomCommand $createSeatsCommand
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(CreateSeatsRoomCommand $createSeatsCommand): void
    {
        $room = $this->roomRepository->findByIdRoom(
            $createSeatsCommand->idRoom()
        );

        $listSeats = [];
        for ($i = 0; $i < $createSeatsCommand->totalSeats(); $i++) {
            $listSeats[] = new Seat(
                $room,
                $createSeatsCommand->price()
            );
        }

        $this->seatRepository->createSeatsRoom($listSeats);
    }
}
