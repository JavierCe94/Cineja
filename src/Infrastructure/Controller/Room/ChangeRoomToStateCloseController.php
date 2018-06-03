<?php

namespace Javier\Cineja\Infrastructure\Controller\Room;

use Javier\Cineja\Application\Room\ChangeRoomToStateClose\ChangeRoomToStateClose;
use Javier\Cineja\Application\Room\ChangeRoomToStateClose\ChangeRoomToStateCloseCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeRoomToStateCloseController extends RoleAdmin
{
    public function __invoke(
        Request $request,
        ChangeRoomToStateClose $changeRoomToStateClose
    ): Response {
        $changeRoomToStateCloseCommand = new ChangeRoomToStateCloseCommand(
            $request->attributes->get('room')
        );

        return new JsonResponse(
            $changeRoomToStateClose->handle(
                $changeRoomToStateCloseCommand
            ),
            Response::HTTP_OK
        );
    }
}
