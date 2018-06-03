<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ShowFilms\ShowFilms;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowFilmsController extends RoleAdmin
{
    public function __invoke(ShowFilms $showFilms): Response
    {
        return new JsonResponse(
            $showFilms->handle(),
            Response::HTTP_OK
        );
    }
}
