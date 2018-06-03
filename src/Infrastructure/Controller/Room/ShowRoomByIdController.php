<?php

namespace Javier\Cineja\Infrastructure\Controller\Room;

use Javier\Cineja\Application\Room\ShowRoomById\ShowRoomById;
use Javier\Cineja\Application\Room\ShowRoomById\ShowRoomByIdCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowRoomByIdController extends RoleAdmin
{
    public function __invoke(Request $request, ShowRoomById $showRoomById)
    {
        $showRoomByIdCommand = new ShowRoomByIdCommand(
            $request->attributes->get('room')
        );

        return new JsonResponse(
            $showRoomById->handle(
                $showRoomByIdCommand
            ),
            Response::HTTP_OK
        );
    }
}
