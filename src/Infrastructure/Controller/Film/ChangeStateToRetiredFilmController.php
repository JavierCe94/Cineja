<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ChangeStateToRetiredFilm\ChangeStateToRetiredFilm;
use Javier\Cineja\Application\Film\ChangeStateToRetiredFilm\ChangeStateToRetiredFilmCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeStateToRetiredFilmController
{
    public function changeStateToRetiredFilm(
        Request $request,
        ChangeStateToRetiredFilm $changeStateToRetiredFilm
    ): Response {
        $changeStateToRetiredFilmCommand = new ChangeStateToRetiredFilmCommand(
            $request->attributes->get('film')
        );
        $response = $changeStateToRetiredFilm->handle($changeStateToRetiredFilmCommand);

        return new JsonResponse(
            $response,
            Response::HTTP_OK
        );
    }
}
