<?php

namespace Javier\Cineja\Infrastructure\Controller\Room;

use Javier\Cineja\Application\Room\ChangeRoomToStateClose\ChangeRoomToStateClose;
use Javier\Cineja\Application\Room\ChangeRoomToStateClose\ChangeRoomToStateCloseCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeRoomToStateCloseController
{
    public function changeRoomToStateClose(Request $request, ChangeRoomToStateClose $changeRoomToStateClose): Response
    {
        $changeRoomToStateCloseCommand = new ChangeRoomToStateCloseCommand(
            $request->attributes->get('room')
        );
        $response = $changeRoomToStateClose->handle($changeRoomToStateCloseCommand);

        return new JsonResponse(
            $response,
            Response::HTTP_OK
        );
    }
}
