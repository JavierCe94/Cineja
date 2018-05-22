<?php

namespace Javier\Cineja\Domain\Services\Room\Seat;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\NotFoundSeatsException;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;

class SearchSeatById
{
    private $seatRepository;

    public function __construct(SeatRepositoryInterface $seatRepository)
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
