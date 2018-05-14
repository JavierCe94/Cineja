<?php

namespace Javier\Cineja\Infrastructure\Controller\Room;

use Javier\Cineja\Application\Room\ChangeRoomToStateClose\ChangeRoomToStateClose;
use Javier\Cineja\Application\Room\ChangeRoomToStateClose\ChangeRoomToStateCloseCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeRoomToStateCloseController extends Controller
{
    public function changeRoomToStateClose(Request $request, ChangeRoomToStateClose $changeRoomToStateClose): Response
    {
        $changeRoomToStateCloseCommand = new ChangeRoomToStateCloseCommand(
            $request->query->get('room')
        );
        $response = $changeRoomToStateClose->handle($changeRoomToStateCloseCommand);

        return $this->json($response);
    }
}
