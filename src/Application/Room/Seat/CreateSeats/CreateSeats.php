<?php

namespace Javier\Cineja\Application\Room\Seat\CreateSeats;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Infrastructure\Repository\Room\RoomRepository;
use Javier\Cineja\Infrastructure\Repository\Room\Seat\SeatRepository;

class CreateSeats
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

    public function handle(CreateSeatsCommand $createSeatsCommand): array
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

        try {
            $this->seatRepository;
        } catch (ORMException $ORMException) {

        }

        return ['ok' => 200];
    }
}
