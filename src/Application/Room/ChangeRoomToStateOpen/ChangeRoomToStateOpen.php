<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateOpen;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;

class ChangeRoomToStateOpen extends RoleAdmin
{
    private $roomRepository;
    private $searchRoomById;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        SearchRoomById $searchRoomById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->roomRepository = $roomRepository;
        $this->searchRoomById = $searchRoomById;
    }

    /**
     * @param ChangeRoomToStateOpenCommand $changeRoomToStateOpenCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException
     */
    public function handle(ChangeRoomToStateOpenCommand $changeRoomToStateOpenCommand): array
    {
        $room = $this->searchRoomById->execute(
            $changeRoomToStateOpenCommand->id()
        );
        $this->roomRepository->changeToStateOpenRoom($room);

        return [
            'data' => 'Se ha abierto la sala con éxito',
            'code' => HttpResponses::OK
        ];
    }
}
