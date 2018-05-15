<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ShowFilmsWithRooms\ShowFilmsWithRooms;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ShowFilmsWithRoomsController extends Controller
{
    public function showFilmsWithRooms(ShowFilmsWithRooms $showFilmsWithRooms): Response
    {
        $response = $showFilmsWithRooms->handle();

        return $this->json($response);
    }
}
