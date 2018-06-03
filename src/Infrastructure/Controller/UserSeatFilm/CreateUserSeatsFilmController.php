<?php

namespace Javier\Cineja\Infrastructure\Controller\UserSeatFilm;

use Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm\CreateUserSeatsFilm;
use Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm\CreateUserSeatsFilmCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserSeatsFilmController extends RoleUser
{
    public function __invoke(Request $request, CreateUserSeatsFilm $createUserSeatsFilm): Response
    {
        $createUserSeatsFilmCommand = new CreateUserSeatsFilmCommand(
            $request->query->get('seats'),
            $request->query->get('filmroom'),
            $request->query->get('codeqr')
        );

        return new JsonResponse(
            $createUserSeatsFilm->handle(
                $createUserSeatsFilmCommand
            ),
            Response::HTTP_CREATED
        );
    }
}
