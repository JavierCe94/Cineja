<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ShowGenres\ShowGenres;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowGenresController extends RoleAdmin
{
    public function showGenres(ShowGenres $showGenres): Response
    {
        return new JsonResponse(
            $showGenres->handle(),
            Response::HTTP_OK
        );
    }
}
