<?php

namespace Javier\Cineja\Infrastructure\Controller\Room\Seat;

use Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom\ShowSeatsFilmRoom;
use Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom\ShowSeatsFilmRoomCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowSeatsFilmRoomController extends Controller
{
    public function showSeatsFilmRoom(Request $request, ShowSeatsFilmRoom $showSeatsFilmRoom): Response
    {
        $showSeatsFilmRoomCommand = new ShowSeatsFilmRoomCommand(
            $request->attributes->get('room'),
            $request->attributes->get('filmroom')
        );
        $response = $showSeatsFilmRoom->handle($showSeatsFilmRoomCommand);

        return $this->json($response);
    }
}
