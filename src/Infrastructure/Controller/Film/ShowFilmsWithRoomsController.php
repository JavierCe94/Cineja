<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ShowFilmsWithRooms\ShowFilmsWithRooms;
use Javier\Cineja\Infrastructure\Util\Role\RoleUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowFilmsWithRoomsController extends RoleUser
{
    public function __invoke(ShowFilmsWithRooms $showFilmsWithRooms): Response
    {
        return new JsonResponse(
            $showFilmsWithRooms->handle(),
            Response::HTTP_OK
        );
    }
}
