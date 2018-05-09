<?php

namespace Javier\Cineja\Application\Film\ShowFilms;

use Javier\Cineja\Infrastructure\Repository\Film\FilmRepository;

class ShowFilms
{
    private $filmRepository;
    private $showFilmTransform;

    public function __construct(
        FilmRepository $filmRepository,
        ShowFilmsTransformInterface $showFilmTransform
    ) {
        $this->filmRepository = $filmRepository;
        $this->showFilmTransform = $showFilmTransform;
    }

    public function handle(): array
    {
        $films = $this->filmRepository->findFilms();

        return $this->showFilmTransform
            ->transform($films);
    }
}
