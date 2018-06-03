<?php

namespace Javier\Cineja\Infrastructure\Controller\Room;

use Javier\Cineja\Application\Room\ChangeRoomToStateOpen\ChangeRoomToStateOpen;
use Javier\Cineja\Application\Room\ChangeRoomToStateOpen\ChangeRoomToStateOpenCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeRoomToStateOpenController extends RoleAdmin
{
    public function __invoke(
        Request $request,
        ChangeRoomToStateOpen $changeRoomToStateOpen
    ): Response {
        $changeRoomToStateOpenCommand = new ChangeRoomToStateOpenCommand(
            $request->attributes->get('room')
        );

        return new JsonResponse(
            $changeRoomToStateOpen->handle(
                $changeRoomToStateOpenCommand
            ),
            Response::HTTP_OK
        );
    }
}