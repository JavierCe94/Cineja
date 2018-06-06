<?php

namespace Javier\Cineja\Application\Film\ShowFilms;

use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository;

class ShowFilms
{
    private $filmRepository;
    private $showFilmTransform;

    public function __construct(
        FilmRepository $filmRepository,
        ShowFilmsTransformI $showFilmTransform
    ) {
        $this->filmRepository = $filmRepository;
        $this->showFilmTransform = $showFilmTransform;
    }

    public function handle(ShowFilmsCommand $showFilmsCommand): array
    {
        if (null === $showFilmsCommand->date()) {
            return $this->showFilmTransform->transform(
                $this->filmRepository->findFilms(
                    null,
                    null
                )
            );
        }

        return $this->showFilmTransform->transform(
            $this->filmRepository->findFilms(
                new \DateTime($showFilmsCommand->date().' 00:00:00'),
                new \DateTime($showFilmsCommand->date().' 23:59:59')
            )
        );
    }
}
