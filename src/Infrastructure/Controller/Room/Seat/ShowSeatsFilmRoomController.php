<?php

namespace Javier\Cineja\Infrastructure\Controller\Room\Seat;

use Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom\ShowSeatsFilmRoom;
use Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom\ShowSeatsFilmRoomCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowSeatsFilmRoomController
{
    public function showSeatsFilmRoom(Request $request, ShowSeatsFilmRoom $showSeatsFilmRoom): Response
    {
        $showSeatsFilmRoomCommand = new ShowSeatsFilmRoomCommand(
            $request->attributes->get('room'),
            $request->attributes->get('filmroom')
        );
        $response = $showSeatsFilmRoom->handle($showSeatsFilmRoomCommand);

        return new JsonResponse(
            $response,
            200
        );
    }
}
