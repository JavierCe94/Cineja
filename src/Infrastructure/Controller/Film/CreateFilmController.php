<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\CreateFilm\CreateFilm;
use Javier\Cineja\Application\Film\CreateFilm\CreateFilmCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateFilmController
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
        $response = $createFilm->handle($createFilmCommand);

        return new JsonResponse(
            $response,
            Response::HTTP_CREATED
        );
    }
}
