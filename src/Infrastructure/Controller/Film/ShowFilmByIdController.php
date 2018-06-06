<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ShowFilmById\ShowFilmById;
use Javier\Cineja\Application\Film\ShowFilmById\ShowFilmByIdCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdminUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowFilmByIdController extends RoleAdminUser
{
    public function __invoke(Request $request, ShowFilmById $showFilmById): Response
    {
        $showFilmByIdCommand = new ShowFilmByIdCommand(
            $request->attributes->get('film')
        );

        return new JsonResponse(
            $showFilmById->handle($showFilmByIdCommand),
            Response::HTTP_OK
        );
    }
}
