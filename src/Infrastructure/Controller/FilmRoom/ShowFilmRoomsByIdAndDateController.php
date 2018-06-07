<?php

namespace Javier\Cineja\Infrastructure\Controller\FilmRoom;

use Javier\Cineja\Application\FilmRoom\ShowFilmRoomsByIdAndDate\ShowFilmRoomsByIdAndDate;
use Javier\Cineja\Application\FilmRoom\ShowFilmRoomsByIdAndDate\ShowFilmRoomsByIdAndDateCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdminUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowFilmRoomsByIdAndDateController extends RoleAdminUser
{
    public function __invoke(Request $request, ShowFilmRoomsByIdAndDate $showFilmRoomsByIdAndDate): Response
    {
        $showFilmRoomsByIdAndDateCommand = new ShowFilmRoomsByIdAndDateCommand(
            $request->attributes->get('film'),
            $request->request->get('date')
        );

        return new JsonResponse(
            $showFilmRoomsByIdAndDate->handle(
                $showFilmRoomsByIdAndDateCommand
            ),
            Response::HTTP_OK
        );
    }
}
