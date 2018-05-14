<?php

namespace Javier\Cineja\Infrastructure\Controller\Room;

use Javier\Cineja\Application\Room\ChangeRoomToStateOpen\ChangeRoomToStateOpen;
use Javier\Cineja\Application\Room\ChangeRoomToStateOpen\ChangeRoomToStateOpenCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeRoomToStateOpenController extends Controller
{
    public function changeRoomToStateOpen(Request $request, ChangeRoomToStateOpen $changeRoomToStateOpen): Response
    {
        $changeRoomToStateOpenCommand = new ChangeRoomToStateOpenCommand(
            $request->query->get('room')
        );
        $response = $changeRoomToStateOpen->handle($changeRoomToStateOpenCommand);

        return $this->json($response);
    }
}