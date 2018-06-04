<?php

namespace Javier\Cineja\Infrastructure\Controller\Room\Seat;

use Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeSpace\ChangeSeatsToTypeSpace;
use Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeSpace\ChangeSeatsToTypeSpaceCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeSeatsToTypeSpaceController extends RoleAdmin
{
    public function __invoke(
        Request $request,
        ChangeSeatsToTypeSpace $changeSeatsToTypeSpace
    ): Response {
        $changeSeatsToTypeSpaceCommand = new ChangeSeatsToTypeSpaceCommand(
            $request->request->get('seats')
        );

        return new JsonResponse(
            $changeSeatsToTypeSpace->handle(
                $changeSeatsToTypeSpaceCommand
            ),
            Response::HTTP_OK
        );
    }
}
