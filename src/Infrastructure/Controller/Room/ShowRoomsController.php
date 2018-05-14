<?php

namespace Javier\Cineja\Infrastructure\Controller\Room;

use Javier\Cineja\Application\Room\ShowRooms\ShowRooms;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ShowRoomsController extends Controller
{
    public function showRooms(ShowRooms $showRooms): Response
    {
        $response = $showRooms->handle();

        return $this->json($response);
    }
}
