<?php

namespace Javier\Cineja\Application\Room\ShowRooms;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepository;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;

class ShowRooms extends RoleAdmin
{
    private $roomRepository;
    private $showRoomsTransform;

    public function __construct(
        RoomRepository $roomRepository,
        ShowRoomsTransformInterface $showRoomsTransform,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->roomRepository = $roomRepository;
        $this->showRoomsTransform = $showRoomsTransform;
    }

    public function handle(): array
    {
        $listRooms = $this->roomRepository->findRooms();

        return $this->showRoomsTransform->transform($listRooms);
    }
}
