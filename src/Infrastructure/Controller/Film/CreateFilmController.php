<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\CreateFilm\CreateFilm;
use Javier\Cineja\Application\Film\CreateFilm\CreateFilmCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateFilmController extends Controller
{
    public function createFilm(Request $request, CreateFilm $createFilm): Response
    {
        $createFilmCommand = new CreateFilmCommand(
            $request->query->get('image'),
            $request->query->get('name'),
            $request->query->get('description'),
            $request->query->get('duration'),
            $request->query->get('minage')
        );
        $response = $createFilm->handle($createFilmCommand);

        return $this->json($response);
    }
}
