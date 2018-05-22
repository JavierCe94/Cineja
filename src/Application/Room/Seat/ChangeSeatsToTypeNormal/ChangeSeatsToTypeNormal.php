<?php

namespace Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\Seat\SeatRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;
use Javier\Cineja\Domain\Services\Room\Seat\SearchSeatById;

class ChangeSeatsToTypeNormal extends RoleAdmin
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
     * @param ChangeSeatsToTypeNormalCommand $changeSeatsToTypeNormalCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\Seat\NotFoundSeatsException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException
     */
    public function handle(ChangeSeatsToTypeNormalCommand $changeSeatsToTypeNormalCommand): array
    {
        $this->checkToken();
        $listSeats = [];
        foreach ($changeSeatsToTypeNormalCommand->seats() as $idSeat) {
            $listSeats[] = $this->searchSeatById->execute($idSeat);
        }
        $this->seatRepository->changeToTypeNormalSeat($listSeats);

        return [
            'data' => 'Se han cambiado las butacas, al tipo normal',
            'code' => HttpResponses::OK
        ];
    }
}
