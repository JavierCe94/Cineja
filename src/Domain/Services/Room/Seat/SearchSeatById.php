<?php

namespace Javier\Cineja\Domain\Services\Room\Seat;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\NotFoundSeatsException;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\Seat;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Util\Observer\ListExceptions;
use Javier\Cineja\Domain\Util\Observer\Observer;

class SearchSeatById implements Observer
{
    private $stateException;
    private $seatRepository;

    public function __construct(SeatRepositoryInterface $seatRepository)
    {
        $this->stateException = false;
        $this->seatRepository = $seatRepository;
    }

    public function execute($id): ?Seat
    {
        $seat = $this->seatRepository->findSeatById($id);
        if (null === $seat) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }

        return $seat;
    }

    /**
     * @throws NotFoundSeatsException
     */
    public function update()
    {
        if ($this->stateException) {
            throw new NotFoundSeatsException();
        }
    }
}
