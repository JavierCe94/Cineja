<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\CreateFilm\CreateFilm;
use Javier\Cineja\Application\Film\CreateFilm\CreateFilmCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateFilmController extends RoleAdmin
{
    public function createFilm(Request $request, CreateFilm $createFilm): Response
    {
        $createFilmCommand = new CreateFilmCommand(
            $request->files->get('image'),
            $request->request->get('name'),
            $request->request->get('description'),
            $request->request->get('duration'),
            $request->request->get('minage')
        );

        return new JsonResponse(
            $createFilm->handle(
                $createFilmCommand
            ),
            Response::HTTP_CREATED
        );
    }
}
