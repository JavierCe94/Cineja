<?php

namespace Javier\Cineja\Infrastructure\Controller\Room\Seat;

use Javier\Cineja\Application\Room\Seat\ShowSeatsRoom\ShowSeatsRoom;
use Javier\Cineja\Application\Room\Seat\ShowSeatsRoom\ShowSeatsRoomCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowSeatsRoomController extends RoleAdmin
{
    public function __invoke(Request $request, ShowSeatsRoom $showSeatsRoom): Response
    {
        $showSeatsRoomCommand = new ShowSeatsRoomCommand(
            $request->attributes->get('room')
        );

        return new JsonResponse(
            $showSeatsRoom->handle(
                $showSeatsRoomCommand
            ),
            Response::HTTP_OK
        );
    }
}
