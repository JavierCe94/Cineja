<?php

namespace Javier\Cineja\Infrastructure\Controller\Room;

use Javier\Cineja\Application\Room\CreateRoom\CreateRoom;
use Javier\Cineja\Application\Room\CreateRoom\CreateRoomCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateRoomController extends RoleAdmin
{
    public function __invoke(Request $request, CreateRoom $createRoom): Response
    {
        $createRoomCommand = new CreateRoomCommand(
            $request->request->get('name'),
            $request->request->get('totalseatsbyrow')
        );

        return new JsonResponse(
            $createRoom->handle(
                $createRoomCommand
            ),
            Response::HTTP_CREATED
        );
    }
}
