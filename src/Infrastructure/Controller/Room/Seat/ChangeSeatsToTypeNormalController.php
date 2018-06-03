<?php

namespace Javier\Cineja\Infrastructure\Controller\Room\Seat;

use Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal\ChangeSeatsToTypeNormal;
use Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal\ChangeSeatsToTypeNormalCommand;
use Javier\Cineja\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeSeatsToTypeNormalController extends RoleAdmin
{
    public function __invoke(
        Request $request,
        ChangeSeatsToTypeNormal $changeSeatsToTypeNormal
    ): Response {
        $changeSeatsToTypeNormalCommand = new ChangeSeatsToTypeNormalCommand(
            $request->query->get('seats')
        );

        return new JsonResponse(
            $changeSeatsToTypeNormal->handle(
                $changeSeatsToTypeNormalCommand
            ),
            Response::HTTP_OK
        );
    }
}
