<?php

namespace Javier\Cineja\Application\Room\ShowRoomById;

use Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException;
use Javier\Cineja\Domain\Services\Room\SearchRoomById;

class ShowRoomById
{
    private $searchRoomById;
    private $showRoomByIdTransform;

    public function __construct(
        SearchRoomById $searchRoomById,
        ShowRoomByIdTransformInterface $showRoomByIdTransform
    ) {
        $this->searchRoomById = $searchRoomById;
        $this->showRoomByIdTransform = $showRoomByIdTransform;
    }

    public function handle(ShowRoomByIdCommand $showRoomByIdCommand): array
    {
        try {
            $rooms = $this->searchRoomById->execute(
                $showRoomByIdCommand->id()
            );
        } catch (NotFoundRoomsException $notFoundRoomsException) {
            return ['ko' => $notFoundRoomsException->getMessage()];
        }

        return $this->showRoomByIdTransform
            ->transform($rooms);
    }
}
