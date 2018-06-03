<?php

namespace Javier\Cineja\Infrastructure\Controller\Room;

use Javier\Cineja\Application\Room\ShowRooms\ShowRooms;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowRoomsController extends RoleAdmin
{
    public function __invoke(ShowRooms $showRooms): Response
    {
        return new JsonResponse(
            $showRooms->handle(),
            Response::HTTP_OK
        );
    }
}
