<?php

namespace Javier\Cineja\Infrastructure\Controller\UserSeatFilm;

use Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm\CreateUserSeatsFilm;
use Javier\Cineja\Application\UserSeatFilm\CreateUserSeatsFilm\CreateUserSeatsFilmCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserSeatsFilmController extends Controller
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

        return $this->json($response);
    }
}
