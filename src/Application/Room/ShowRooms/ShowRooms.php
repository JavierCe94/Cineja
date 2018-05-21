<?php

namespace Javier\Cineja\Application\Room\ShowRooms;

use Javier\Cineja\Domain\Model\Entity\Room\RoomRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Model\JwtToken\Roles;
use Javier\Cineja\Domain\Services\Util\JwtToken\CheckToken;

class ShowRooms
{
    private $roomRepository;
    private $showRoomsTransform;
    private $checkToken;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        ShowRoomsTransformInterface $showRoomsTransform,
        CheckToken $checkToken
    ) {
        $this->roomRepository = $roomRepository;
        $this->showRoomsTransform = $showRoomsTransform;
        $this->checkToken = $checkToken;
    }

    public function handle(): array
    {
        try {
            $this->checkToken->execute(Roles::ROLE_ADMIN);
        } catch (\Exception $exception) {
            return [
                'data' => $exception->getMessage(),
                'code' => $exception->getCode()
            ];
        }
        $listRooms = $this->roomRepository->findRooms();

        return [
            'data' => $this->showRoomsTransform->transform($listRooms),
            'code' => HttpResponses::OK
        ];
    }
}
