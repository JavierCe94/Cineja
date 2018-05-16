<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ShowFilmsWithRooms\ShowFilmsWithRooms;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowFilmsWithRoomsController
{
    public function showFilmsWithRooms(ShowFilmsWithRooms $showFilmsWithRooms): Response
    {
        $response = $showFilmsWithRooms->handle();

        return new JsonResponse(
            $response,
            200
        );
    }
}
