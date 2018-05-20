<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ShowGenres\ShowGenres;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowGenresController
{
    public function showGenres(ShowGenres $showGenres): Response
    {
        $response = $showGenres->handle();

        return new JsonResponse(
            $response['data'],
            $response['code']
        );
    }
}
