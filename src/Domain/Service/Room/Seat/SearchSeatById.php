<?php

namespace Javier\Cineja\Domain\Service\Room\Seat;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\NotFoundSeatsException;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepository;

class SearchSeatById
{
    private $seatRepository;

    public function __construct(SeatRepository $seatRepository)
    {
        $this->seatRepository = $seatRepository;
    }

    /**
     * @param $id
     * @return Seat|null
     * @throws NotFoundSeatsException
     */
    public function execute($id): Seat
    {
        $seat = $this->seatRepository->findSeatById($id);
        if (null === $seat) {
            throw new NotFoundSeatsException();
        }

        return $seat;
    }
}
