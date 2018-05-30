<?php

namespace Javier\Cineja\Application\Room\Seat\CreateSeatsRoom;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepository;
use Javier\Cineja\Domain\Service\Room\SearchRoomById;

class CreateSeatsRoom
{
    private $seatRepository;
    private $createSeatsRoomTransform;
    private $searchRoomById;

    public function __construct(
        SeatRepository $seatRepository,
        CreateSeatsRoomTransformInterface $createSeatsRoomTransform,
        SearchRoomById $searchRoomById
    ) {
        $this->seatRepository = $seatRepository;
        $this->createSeatsRoomTransform = $createSeatsRoomTransform;
        $this->searchRoomById = $searchRoomById;
    }

    /**
     * @param CreateSeatsRoomCommand $createSeatsRoomCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException
     */
    public function handle(CreateSeatsRoomCommand $createSeatsRoomCommand): string
    {
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

        return $this->createSeatsRoomTransform->transform();
    }
}
