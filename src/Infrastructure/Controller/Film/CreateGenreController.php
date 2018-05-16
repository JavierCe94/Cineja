<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\CreateGenre\CreateGenre;
use Javier\Cineja\Application\Film\CreateGenre\CreateGenreCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateGenreController
{
    public function createGenre(Request $request, CreateGenre $createGenre): Response
    {
        $createGenreCommand = new CreateGenreCommand(
            $request->query->get('name')
        );
        $response = $createGenre->handle($createGenreCommand);

        return new JsonResponse(
            $response['data'],
            $response['code']
        );
    }
}
