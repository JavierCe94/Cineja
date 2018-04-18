<?php

namespace Javier\Cineja\Infrastructure\Controller\Admin\Film;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FilmController extends Controller
{
     public function showFilms(): Response
     {
        return $this->render(
            'Admin/Film/list_movies.html.twig',
            []
        );
     }
}