<?php

namespace Javier\Cineja\Infrastructure\Controller\Film\FilmGenre;

use Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre\CreateFilmGenre;
use Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre\CreateFilmGenreCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateFilmGenreController
{
    public function createFilmGenre(Request $request, CreateFilmGenre $createFilmGenre): Response
    {
        $createFilmGenreCommand = new CreateFilmGenreCommand(
            $request->query->get('film'),
            $request->query->get('genre')
        );
        $response = $createFilmGenre->handle($createFilmGenreCommand);

        return new JsonResponse(
            $response,
            Response::HTTP_CREATED
        );
    }
}
