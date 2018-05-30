<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ChangeStateToRetiredFilm\ChangeStateToRetiredFilm;
use Javier\Cineja\Application\Film\ChangeStateToRetiredFilm\ChangeStateToRetiredFilmCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeStateToRetiredFilmController extends RoleAdmin
{
    public function changeStateToRetiredFilm(
        Request $request,
        ChangeStateToRetiredFilm $changeStateToRetiredFilm
    ): Response {
        $changeStateToRetiredFilmCommand = new ChangeStateToRetiredFilmCommand(
            $request->attributes->get('film')
        );

        return new JsonResponse(
            $changeStateToRetiredFilm->handle(
                $changeStateToRetiredFilmCommand
            ),
            Response::HTTP_OK
        );
    }
}
