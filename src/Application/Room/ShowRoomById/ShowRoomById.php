<?php

namespace Javier\Cineja\Application\Room\ShowRoomById;

use Javier\Cineja\Domain\Service\Room\SearchRoomById;

class ShowRoomById
{
    private $searchRoomById;
    private $showRoomByIdTransform;

    public function __construct(
        SearchRoomById $searchRoomById,
        ShowRoomByIdTransformI $showRoomByIdTransform
    ) {
        $this->searchRoomById = $searchRoomById;
        $this->showRoomByIdTransform = $showRoomByIdTransform;
    }

    /**
     * @param ShowRoomByIdCommand $showRoomByIdCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\Entity\Room\NotFoundRoomsException
     */
    public function handle(ShowRoomByIdCommand $showRoomByIdCommand): array
    {
        return $this->showRoomByIdTransform->transform(
            $this->searchRoomById->execute(
                $showRoomByIdCommand->id()
            )
        );
    }
}
