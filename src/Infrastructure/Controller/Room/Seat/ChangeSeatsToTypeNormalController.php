<?php

namespace Javier\Cineja\Infrastructure\Controller\Room\Seat;

use Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal\ChangeSeatsToTypeNormal;
use Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal\ChangeSeatsToTypeNormalCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeSeatsToTypeNormalController
{
    public function changeSeatsToTypeNormal(
        Request $request,
        ChangeSeatsToTypeNormal $changeSeatsToTypeNormal
    ): Response {
        $changeSeatsToTypeNormalCommand = new ChangeSeatsToTypeNormalCommand(
            $request->query->get('seats')
        );
        $response = $changeSeatsToTypeNormal->handle($changeSeatsToTypeNormalCommand);

        return new JsonResponse(
            $response,
            Response::HTTP_OK
        );
    }
}
