<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ShowFilmsWithRooms\ShowFilmsWithRooms;
use Javier\Cineja\Application\Film\ShowFilmsWithRooms\ShowFilmsWithRoomsCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowFilmsWithRoomsController extends RoleUser
{
    public function __invoke(Request $request, ShowFilmsWithRooms $showFilmsWithRooms): Response
    {
        $showFilmsWithRoomsCommand = new ShowFilmsWithRoomsCommand(
            $request->request->get('date')
        );

        return new JsonResponse(
            $showFilmsWithRooms->handle(
                $showFilmsWithRoomsCommand
            ),
            Response::HTTP_OK
        );
    }
}
