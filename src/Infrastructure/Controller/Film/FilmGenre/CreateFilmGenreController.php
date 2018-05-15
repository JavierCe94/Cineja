<?php

namespace Javier\Cineja\Infrastructure\Controller\Film\FilmGenre;

use Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre\CreateFilmGenre;
use Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre\CreateFilmGenreCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateFilmGenreController extends Controller
{
    public function createFilmGenre(Request $request, CreateFilmGenre $createFilmGenre): Response
    {
        $createFilmGenreCommand = new CreateFilmGenreCommand(
            $request->query->get('film'),
            $request->query->get('genre')
        );
        $response = $createFilmGenre->handle($createFilmGenreCommand);

        return $this->json($response);
    }
}
