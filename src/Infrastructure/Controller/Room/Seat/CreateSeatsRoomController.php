<?php

namespace Javier\Cineja\Infrastructure\Controller\Room\Seat;

use Javier\Cineja\Application\Room\Seat\CreateSeatsRoom\CreateSeatsRoom;
use Javier\Cineja\Application\Room\Seat\CreateSeatsRoom\CreateSeatsRoomCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateSeatsRoomController extends Controller
{
    public function createSeatsRoom(Request $request, CreateSeatsRoom $createSeatsRoom): Response
    {
        $createSeatsRoomCommand = new CreateSeatsRoomCommand(
            $request->attributes->get('room'),
            $request->query->get('priceseat'),
            $request->query->get('totalseatsroom')
        );
        $response = $createSeatsRoom->handle($createSeatsRoomCommand);

        return $this->json($response);
    }
}