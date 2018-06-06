<?php

namespace Javier\Cineja\Infrastructure\Controller\FilmRoom;

use Javier\Cineja\Application\FilmRoom\CreateFilmRoom\CreateFilmRoom;
use Javier\Cineja\Application\FilmRoom\CreateFilmRoom\CreateFilmRoomCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateFilmRoomController extends RoleAdmin
{
    public function __invoke(Request $request, CreateFilmRoom $createFilmRoom): Response
    {
        $createFilmRoomCommand = new CreateFilmRoomCommand(
            $request->request->get('film'),
            $request->request->get('room'),
            $request->request->get('releasedate')
        );

        return new JsonResponse(
            $createFilmRoom->handle(
                $createFilmRoomCommand
            ),
            Response::HTTP_CREATED
        );
    }
}
