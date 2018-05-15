<?php

namespace Javier\Cineja\Infrastructure\Controller\Room\Seat;

use Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeSpace\ChangeSeatsToTypeSpace;
use Javier\Cineja\Application\Room\Seat\ChangeSeatsToTypeSpace\ChangeSeatsToTypeSpaceCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeSeatsToTypeSpaceController extends Controller
{
    public function changeSeatsToTypeSpace(
        Request $request,
        ChangeSeatsToTypeSpace $changeSeatsToTypeSpace
    ): Response {
        $changeSeatsToTypeSpaceCommand = new ChangeSeatsToTypeSpaceCommand(
            $request->query->get('seats')
        );
        $response = $changeSeatsToTypeSpace->handle($changeSeatsToTypeSpaceCommand);

        return $this->json($response);
    }
}
