<?php

namespace Javier\Cineja\Infrastructure\Controller\FilmRoom;

use Javier\Cineja\Application\FilmRoom\CreateFilmRoom\CreateFilmRoom;
use Javier\Cineja\Application\FilmRoom\CreateFilmRoom\CreateFilmRoomCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateFilmRoomController extends Controller
{
    public function createFilmRoom(Request $request, CreateFilmRoom $createFilmRoom): Response
    {
        $createFilmRoomCommand = new CreateFilmRoomCommand(
            $request->query->get('film'),
            $request->query->get('room'),
            $request->query->get('releasedate')
        );
        $response = $createFilmRoom->handle($createFilmRoomCommand);

        return $this->json($response);
    }
}
