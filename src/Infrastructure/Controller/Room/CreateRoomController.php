<?php

namespace Javier\Cineja\Infrastructure\Controller\Room;

use Javier\Cineja\Application\Room\CreateRoom\CreateRoom;
use Javier\Cineja\Application\Room\CreateRoom\CreateRoomCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateRoomController extends Controller
{
    public function createController(Request $request, CreateRoom $createRoom): Response
    {
        $createRoomCommand = new CreateRoomCommand(
            $request->query->get('name'),
            $request->query->get('totalseatsbyrow')
        );
        $response = $createRoom->handle($createRoomCommand);

        return $this->json($response);
    }
}
