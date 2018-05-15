<?php

namespace Javier\Cineja\Infrastructure\Controller\Room\Seat;

use Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal\ChangeSeatsToTypeNormal;
use Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeNormal\ChangeSeatsToTypeNormalCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeSeatsToTypeNormalController extends Controller
{
    public function changeSeatsToTypeNormal(
        Request $request,
        ChangeSeatsToTypeNormal $changeSeatsToTypeNormal
    ): Response {
        $changeSeatsToTypeNormalCommand = new ChangeSeatsToTypeNormalCommand(
            $request->query->get('seats')
        );
        $response = $changeSeatsToTypeNormal->handle($changeSeatsToTypeNormalCommand);

        return $this->json($response);
    }
}
