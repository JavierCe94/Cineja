<?php

namespace Javier\Cineja\Infrastructure\Controller\Film\FilmGenre;

use Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre\CreateFilmGenre;
use Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre\CreateFilmGenreCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateFilmGenreController extends RoleAdmin
{
    public function __invoke(Request $request, CreateFilmGenre $createFilmGenre): Response
    {
        $createFilmGenreCommand = new CreateFilmGenreCommand(
            $request->request->get('film'),
            $request->request->get('genre')
        );

        return new JsonResponse(
            $createFilmGenre->handle(
                $createFilmGenreCommand
            ),
            Response::HTTP_CREATED
        );
    }
}
