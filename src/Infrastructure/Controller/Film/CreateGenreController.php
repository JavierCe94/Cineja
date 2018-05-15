<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\CreateGenre\CreateGenre;
use Javier\Cineja\Application\Film\CreateGenre\CreateGenreCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateGenreController extends Controller
{
    public function createGenre(Request $request, CreateGenre $createGenre): Response
    {
        $createGenreCommand = new CreateGenreCommand(
            $request->query->get('name')
        );
        $response = $createGenre->handle($createGenreCommand);

        return $this->json($response);
    }
}
