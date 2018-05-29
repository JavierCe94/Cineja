<?php

namespace Javier\Cineja\Infrastructure\Controller\Room\Seat;

use Javier\Cineja\Application\Room\Seat\CreateSeatsRoom\CreateSeatsRoom;
use Javier\Cineja\Application\Room\Seat\CreateSeatsRoom\CreateSeatsRoomCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateSeatsRoomController
{
    public function createSeatsRoom(Request $request, CreateSeatsRoom $createSeatsRoom): Response
    {
        $createSeatsRoomCommand = new CreateSeatsRoomCommand(
            $request->attributes->get('room'),
            $request->query->get('priceseat'),
            $request->query->get('totalseatsroom')
        );
        $response = $createSeatsRoom->handle($createSeatsRoomCommand);

        return new JsonResponse(
            $response,
            Response::HTTP_CREATED
        );
    }
}
