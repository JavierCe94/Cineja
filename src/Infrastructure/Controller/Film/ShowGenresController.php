<?php

namespace Javier\Cineja\Infrastructure\Controller\Film;

use Javier\Cineja\Application\Film\ShowGenres\ShowGenres;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ShowGenresController extends Controller
{
    public function showGenres(ShowGenres $showGenres): Response
    {
        $response = $showGenres->handle();

        return $this->json($response);
    }
}
