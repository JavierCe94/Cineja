<?php

namespace Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeSpace;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\NotFoundSeatsException;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Services\Room\Seat\SearchSeatById;

class ChangeSeatsToTypeSpace
{
    private $seatRepository;
    private $searchSeatById;

    public function __construct(SeatRepositoryInterface $seatRepository, SearchSeatById $searchSeatById)
    {
        $this->seatRepository = $seatRepository;
        $this->searchSeatById = $searchSeatById;
    }

    public function handle(ChangeSeatsToTypeSpaceCommand $changeSeatsToTypeSpaceCommand): array
    {
        $listSeats = [];
        foreach ($changeSeatsToTypeSpaceCommand->seats() as $idSeat) {
            try {
                $listSeats[] = $this->searchSeatById->execute($idSeat);
            } catch (NotFoundSeatsException $notFoundSeatsException) {
                return [
                    'data' => $notFoundSeatsException->getMessage(),
                    'code' => $notFoundSeatsException->getCode()
                ];
            }
        }
        $this->seatRepository->changeToTypeSpaceSeat($listSeats);

        return [
            'data' => 'Se han cambiado las butacas, al tipo space',
            'code' => 200
        ];
    }
}
