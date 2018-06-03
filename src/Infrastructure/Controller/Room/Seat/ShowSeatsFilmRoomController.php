<?php

namespace Javier\Cineja\Infrastructure\Controller\Room\Seat;

use Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom\ShowSeatsFilmRoom;
use Javier\Cineja\Application\Room\Seat\ShowSeatsFilmRoom\ShowSeatsFilmRoomCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowSeatsFilmRoomController extends RoleUser
{
    public function __invoke(Request $request, ShowSeatsFilmRoom $showSeatsFilmRoom): Response
    {
        $showSeatsFilmRoomCommand = new ShowSeatsFilmRoomCommand(
            $request->attributes->get('room'),
            $request->attributes->get('filmroom')
        );

        return new JsonResponse(
            $showSeatsFilmRoom->handle(
                $showSeatsFilmRoomCommand
            ),
            Response::HTTP_OK
        );
    }
}
