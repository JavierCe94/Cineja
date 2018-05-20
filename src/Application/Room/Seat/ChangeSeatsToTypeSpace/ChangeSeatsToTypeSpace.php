<?php

namespace Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeSpace;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Room\Seat\SearchSeatById;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;

class ChangeSeatsToTypeSpace
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

    public function handle(ChangeSeatsToTypeSpaceCommand $changeSeatsToTypeSpaceCommand): array
    {
        $listSeats = [];
        foreach ($changeSeatsToTypeSpaceCommand->seats() as $idSeat) {
            $listSeats[] = $this->searchSeatById->execute($idSeat);
            if (ListExceptions::instance()->checkForExceptions()) {
                return ListExceptions::instance()->firstException();
            }
        }
        $this->seatRepository->changeToTypeSpaceSeat($listSeats);

        return [
            'data' => 'Se han cambiado las butacas, al tipo space',
            'code' => HttpResponses::OK
        ];
    }
}
