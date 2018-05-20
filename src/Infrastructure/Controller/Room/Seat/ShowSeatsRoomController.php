<?php

namespace Javier\Cineja\Infrastructure\Controller\Room\Seat;

use Javier\Cineja\Application\Room\Seat\ShowSeatsRoom\ShowSeatsRoom;
use Javier\Cineja\Application\Room\Seat\ShowSeatsRoom\ShowSeatsRoomCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowSeatsRoomController
{
    public function showSeatsRoom(Request $request, ShowSeatsRoom $showSeatsRoom): Response
    {
        $showSeatsRoomCommand = new ShowSeatsRoomCommand(
            $request->attributes->get('room')
        );
        $response = $showSeatsRoom->handle($showSeatsRoomCommand);

        return new JsonResponse(
            $response['data'],
            $response['code']
        );
    }
}
