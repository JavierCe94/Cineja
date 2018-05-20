<?php

namespace Javier\Cineja\Application\Film\ShowFilms;

use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class ShowFilms
{
    private $filmRepository;
    private $showFilmTransform;

    public function __construct(
        FilmRepositoryInterface $filmRepository,
        ShowFilmsTransformInterface $showFilmTransform
    ) {
        $this->filmRepository = $filmRepository;
        $this->showFilmTransform = $showFilmTransform;
    }

    public function handle(): array
    {
        $films = $this->filmRepository->findFilms();

        return [
            'data' => $this->showFilmTransform->transform($films),
            'code' => HttpResponses::OK
        ];
    }
}
