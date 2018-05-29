<?php

namespace Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeSpace;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepository;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;
use Javier\Cineja\Domain\Service\Room\Seat\SearchSeatById;

class ChangeSeatsToTypeSpace extends RoleAdmin
{
    private $seatRepository;
    private $changeSeatsToTypeSpaceTransform;
    private $searchSeatById;

    public function __construct(
        SeatRepository $seatRepository,
        ChangeSeatsToTypeSpaceTransformInterface $changeSeatsToTypeSpaceTransform,
        SearchSeatById $searchSeatById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->seatRepository = $seatRepository;
        $this->changeSeatsToTypeSpaceTransform = $changeSeatsToTypeSpaceTransform;
        $this->searchSeatById = $searchSeatById;
    }

    /**
     * @param ChangeSeatsToTypeSpaceCommand $changeSeatsToTypeSpaceCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\Seat\NotFoundSeatsException
     */
    public function handle(ChangeSeatsToTypeSpaceCommand $changeSeatsToTypeSpaceCommand): string
    {
        $listSeats = [];
        foreach ($changeSeatsToTypeSpaceCommand->seats() as $idSeat) {
            $listSeats[] = $this->searchSeatById->execute($idSeat);
        }
        $this->seatRepository->changeToTypeSpaceSeat($listSeats);

        return $this->changeSeatsToTypeSpaceTransform->transform();
    }
}
