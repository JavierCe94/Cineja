<?php

namespace Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepository;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;
use Javier\Cineja\Domain\Service\Room\Seat\SearchSeatById;

class ChangeSeatsToTypeNormal extends RoleAdmin
{
    private $seatRepository;
    private $changeSeatsToTypeNormalTransform;
    private $searchSeatById;

    public function __construct(
        SeatRepository $seatRepository,
        ChangeSeatsToTypeNormalTransformInterface $changeSeatsToTypeNormalTransform,
        SearchSeatById $searchSeatById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
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
        $this->seatRepository->changeToTypeNormalSeat($listSeats);

        return $this->changeSeatsToTypeNormalTransform->transform();
    }
}
