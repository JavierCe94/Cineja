<?php

namespace Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Room\Seat\SearchSeatById;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;

class ChangeSeatsToTypeNormal
{
    private $seatRepository;
    private $searchSeatById;

    public function __construct(SeatRepositoryInterface $seatRepository, SearchSeatById $searchSeatById)
    {
        $this->seatRepository = $seatRepository;
        $this->searchSeatById = $searchSeatById;
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($searchSeatById);
    }

    public function handle(ChangeSeatsToTypeNormalCommand $changeSeatsToTypeNormalCommand): array
    {
        $listSeats = [];
        foreach ($changeSeatsToTypeNormalCommand->seats() as $idSeat) {
            $listSeats[] = $this->searchSeatById->execute($idSeat);
            if (ListExceptions::instance()->checkForExceptions()) {
                return ListExceptions::instance()->firstException();
            }
        }
        $this->seatRepository->changeToTypeNormalSeat($listSeats);

        return [
            'data' => 'Se han cambiado las butacas, al tipo normal',
            'code' => HttpResponses::OK
        ];
    }
}
