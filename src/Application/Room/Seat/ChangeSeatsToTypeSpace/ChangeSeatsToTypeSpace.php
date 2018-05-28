<?php

namespace Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeSpace;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;
use Javier\Cineja\Domain\Services\Room\Seat\SearchSeatById;

class ChangeSeatsToTypeSpace extends RoleAdmin
{
    private $seatRepository;
    private $searchSeatById;

    public function __construct(
        SeatRepositoryInterface $seatRepository,
        SearchSeatById $searchSeatById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->seatRepository = $seatRepository;
        $this->searchSeatById = $searchSeatById;
    }

    /**
     * @param ChangeSeatsToTypeSpaceCommand $changeSeatsToTypeSpaceCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\Seat\NotFoundSeatsException
     */
    public function handle(ChangeSeatsToTypeSpaceCommand $changeSeatsToTypeSpaceCommand): array
    {
        $listSeats = [];
        foreach ($changeSeatsToTypeSpaceCommand->seats() as $idSeat) {
            $listSeats[] = $this->searchSeatById->execute($idSeat);
        }
        $this->seatRepository->changeToTypeSpaceSeat($listSeats);

        return [
            'data' => 'Se han cambiado las butacas, al tipo space',
            'code' => HttpResponses::OK
        ];
    }
}
