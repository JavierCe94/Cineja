<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\CreateGenre\CreateGenre;
use Javier\Cineja\Application\Film\CreateGenre\CreateGenreCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateGenreController extends RoleAdmin
{
    public function __invoke(Request $request, CreateGenre $createGenre): Response
    {
        $createGenreCommand = new CreateGenreCommand(
            $request->request->get('name')
        );

        return new JsonResponse(
            $createGenre->handle(
                $createGenreCommand
            ),
            Response::HTTP_CREATED
        );
    }
}
