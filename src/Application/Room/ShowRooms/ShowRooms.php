<?php

namespace Javier\Cineja\Application\Room\ShowRooms;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class ShowRooms extends RoleAdmin
{
    private $roomRepository;
    private $showRoomsTransform;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        ShowRoomsTransformInterface $showRoomsTransform,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->roomRepository = $roomRepository;
        $this->showRoomsTransform = $showRoomsTransform;
    }

    /**
     * @return array
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException
     */
    public function handle(): array
    {
        $this->checkToken();
        $listRooms = $this->roomRepository->findRooms();

        return [
            'data' => $this->showRoomsTransform->transform($listRooms),
            'code' => HttpResponses::OK
        ];
    }
}
