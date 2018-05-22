<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateClose;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;

class ChangeRoomToStateClose extends RoleAdmin
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
     * @param ChangeRoomToStateCloseCommand $changeRoomToStateCloseCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException
     */
    public function handle(ChangeRoomToStateCloseCommand $changeRoomToStateCloseCommand): array
    {
        $this->checkToken();
        $room = $this->searchRoomById->execute(
            $changeRoomToStateCloseCommand->id()
        );
        $this->roomRepository->changeToStateCloseRoom($room);

        return [
            'data' => 'Se ha cerrado la sala con éxito',
            'code' => HttpResponses::OK
        ];
    }
}
