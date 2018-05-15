<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ShowFilms\ShowFilms;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ShowFilmsController extends Controller
{
    public function showFilms(ShowFilms $showFilms): Response
    {
        $response = $showFilms->handle();

        return $this->json($response);
    }
}
