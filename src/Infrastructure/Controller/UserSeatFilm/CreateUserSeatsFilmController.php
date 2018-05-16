<?php

namespace Javier\Cineja\Infrastructure\Controller\UserSeatFilm;

use Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm\CreateUserSeatsFilm;
use Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm\CreateUserSeatsFilmCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserSeatsFilmController
{
    public function createUserSeatsFilm(Request $request, CreateUserSeatsFilm $createUserSeatsFilm): Response
    {
        $createUserSeatsFilmCommand = new CreateUserSeatsFilmCommand(
            $request->query->get('seats'),
            $request->query->get('filmroom'),
            $request->query->get('user'),
            $request->query->get('codeqr')
        );
        $response = $createUserSeatsFilm->handle($createUserSeatsFilmCommand);

        return new JsonResponse(
            $response['data'],
            $response['code']
        );
    }
}
