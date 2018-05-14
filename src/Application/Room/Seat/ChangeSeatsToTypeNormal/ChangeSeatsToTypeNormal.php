<?php

namespace Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal;

use Javier\Cineja\Domain\Model\Entity\Room\Seat\NotFoundSeatsException;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Services\Room\Seat\SearchSeatById;

class ChangeSeatsToTypeNormal
{
    private $seatRepository;
    private $searchSeatById;

    public function __construct(SeatRepositoryInterface $seatRepository, SearchSeatById $searchSeatById)
    {
        $this->seatRepository = $seatRepository;
        $this->searchSeatById = $searchSeatById;
    }

    public function handle(ChangeSeatsToTypeNormalCommand $changeSeatsToTypeNormalCommand): array
    {
        $listSeats = [];
        foreach ($changeSeatsToTypeNormalCommand->seats() as $idSeat) {
            try {
                $listSeats[] = $this->searchSeatById->execute($idSeat);
            } catch (NotFoundSeatsException $notFoundSeatsException) {
                return ['ko' => $notFoundSeatsException->getMessage()];
            }
        }
        $this->seatRepository->changeToTypeNormalSeat($listSeats);

        return ['ok' => 200];
    }
}
