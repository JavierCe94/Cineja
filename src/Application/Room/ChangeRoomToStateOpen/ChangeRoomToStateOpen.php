<?php

namespace Javier\Cineja\Application\Room\ChangeRoomToStateOpen;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepository;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;
use Javier\Cineja\Domain\Service\Room\SearchRoomById;

class ChangeRoomToStateOpen extends RoleAdmin
{
    private $roomRepository;
    private $changeRoomToStateOpenTransform;
    private $searchRoomById;

    public function __construct(
        RoomRepository $roomRepository,
        ChangeRoomToStateOpenTransformInterface $changeRoomToStateOpenTransform,
        SearchRoomById $searchRoomById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->roomRepository = $roomRepository;
        $this->changeRoomToStateOpenTransform = $changeRoomToStateOpenTransform;
        $this->searchRoomById = $searchRoomById;
    }

    /**
     * @param ChangeRoomToStateOpenCommand $changeRoomToStateOpenCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException
     */
    public function handle(ChangeRoomToStateOpenCommand $changeRoomToStateOpenCommand): string
    {
        $room = $this->searchRoomById->execute(
            $changeRoomToStateOpenCommand->id()
        );
        $this->roomRepository->changeToStateOpenRoom($room);

        return $this->changeRoomToStateOpenTransform->transform();
    }
}
