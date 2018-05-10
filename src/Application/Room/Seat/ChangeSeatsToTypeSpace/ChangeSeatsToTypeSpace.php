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

    /**
     * @param ChangeSeatsToTypeSpaceCommand $changeSeatsToTypeSpaceCommand
     * @return array
     */
    public function handle(ChangeSeatsToTypeSpaceCommand $changeSeatsToTypeSpaceCommand): array
    {
        $listSeats = [];
        foreach ($changeSeatsToTypeSpaceCommand->seats() as $idSeat) {
            try {
                $listSeats[] = $this->searchSeatById->execute($idSeat);
            } catch (NotFoundSeatsException $notFoundSeatsException) {
                return ['ko' => $notFoundSeatsException->getMessage()];
            }
        }
        $this->seatRepository->changeToTypeSpaceSeat($listSeats);

        return ['ok' => 200];
    }
}
