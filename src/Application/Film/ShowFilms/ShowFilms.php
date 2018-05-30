<?php

namespace Javier\Cineja\Application\Film\ShowFilms;

use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository;

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
        return $this->showFilmTransform->transform(
            $this->filmRepository->findFilms()
        );
    }
}
