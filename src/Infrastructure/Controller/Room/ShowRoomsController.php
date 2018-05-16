<?php

namespace Javier\Cineja\Infrastructure\Controller\Room;

use Javier\Cineja\Application\Room\ShowRooms\ShowRooms;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowRoomsController
{
    public function showRooms(ShowRooms $showRooms): Response
    {
        $response = $showRooms->handle();

        return new JsonResponse(
            $response,
            200
        );
    }
}
