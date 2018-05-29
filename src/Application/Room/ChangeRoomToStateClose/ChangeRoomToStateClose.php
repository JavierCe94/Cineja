<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateClose;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepository;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;
use Javier\Cineja\Domain\Service\Room\SearchRoomById;

class ChangeRoomToStateClose extends RoleAdmin
{
    private $roomRepository;
    private $changeRoomToStateCloseTransform;
    private $searchRoomById;

    public function __construct(
        RoomRepository $roomRepository,
        ChangeRoomToStateCloseTransformInterface $changeRoomToStateCloseTransform,
        SearchRoomById $searchRoomById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->roomRepository = $roomRepository;
        $this->changeRoomToStateCloseTransform = $changeRoomToStateCloseTransform;
        $this->searchRoomById = $searchRoomById;
    }

    /**
     * @param ChangeRoomToStateCloseCommand $changeRoomToStateCloseCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException
     */
    public function handle(ChangeRoomToStateCloseCommand $changeRoomToStateCloseCommand): string
    {
        $room = $this->searchRoomById->execute(
            $changeRoomToStateCloseCommand->id()
        );
        $this->roomRepository->changeToStateCloseRoom($room);

        return $this->changeRoomToStateCloseTransform->transform();
    }
}
