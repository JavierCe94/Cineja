<?php

namespace Javier\Cineja\Infrastructure\Controller\Room;

use Javier\Cineja\Application\Room\ChangeRoomToStateOpen\ChangeRoomToStateOpen;
use Javier\Cineja\Application\Room\ChangeRoomToStateOpen\ChangeRoomToStateOpenCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeRoomToStateOpenController
{
    public function changeRoomToStateOpen(Request $request, ChangeRoomToStateOpen $changeRoomToStateOpen): Response
    {
        $changeRoomToStateOpenCommand = new ChangeRoomToStateOpenCommand(
            $request->attributes->get('room')
        );
        $response = $changeRoomToStateOpen->handle($changeRoomToStateOpenCommand);

        return new JsonResponse(
            $response['data'],
            $response['code']
        );
    }
}