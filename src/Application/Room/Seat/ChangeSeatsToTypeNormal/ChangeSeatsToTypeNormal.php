<?php

namespace Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepository;
use Javier\Cineja\Domain\Service\Room\Seat\SearchSeatById;

class ChangeSeatsToTypeNormal
{
    private $seatRepository;
    private $changeSeatsToTypeNormalTransform;
    private $searchSeatById;

    public function __construct(
        SeatRepository $seatRepository,
        ChangeSeatsToTypeNormalTransformI $changeSeatsToTypeNormalTransform,
        SearchSeatById $searchSeatById
    ) {
        $this->seatRepository = $seatRepository;
        $this->changeSeatsToTypeNormalTransform = $changeSeatsToTypeNormalTransform;
        $this->searchSeatById = $searchSeatById;
    }

    /**
     * @param ChangeSeatsToTypeNormalCommand $changeSeatsToTypeNormalCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\Seat\NotFoundSeatsException
     */
    public function handle(ChangeSeatsToTypeNormalCommand $changeSeatsToTypeNormalCommand): string
    {
        $listSeats = [];
        foreach ($changeSeatsToTypeNormalCommand->seats() as $idSeat) {
            $listSeats[] = $this->searchSeatById->execute($idSeat);
        }
        $this->seatRepository->changeTypeSeat($listSeats, false);

        return $this->changeSeatsToTypeNormalTransform->transform();
    }
}
