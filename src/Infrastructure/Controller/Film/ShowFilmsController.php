<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ShowFilms\ShowFilms;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowFilmsController
{
    public function showFilms(ShowFilms $showFilms): Response
    {
        $response = $showFilms->handle();

        return new JsonResponse(
            $response,
            Response::HTTP_OK
        );
    }
}
