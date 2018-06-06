<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ShowFilms\ShowFilms;
use Javier\Cineja\Application\Film\ShowFilms\ShowFilmsCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowFilmsController extends RoleAdmin
{
    public function __invoke(Request $request, ShowFilms $showFilms): Response
    {
        $showFilmsCommand = new ShowFilmsCommand(
            $request->request->get('date')
        );

        return new JsonResponse(
            $showFilms->handle(
                $showFilmsCommand
            ),
            Response::HTTP_OK
        );
    }
}
