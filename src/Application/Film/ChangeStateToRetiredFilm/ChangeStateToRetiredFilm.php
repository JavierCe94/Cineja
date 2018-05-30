<?php

namespace Javier\Cineja\Application\Film\ChangeStateToRetiredFilm;

use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository;
use Javier\Cineja\Domain\Service\Film\SearchFilmById;

class ChangeStateToRetiredFilm
{
    private $filmRepository;
    private $changeStateToRetiredFilmTransform;
    private $searchFilmById;

    public function __construct(
        FilmRepository $filmRepository,
        ChangeStateToRetiredFilmTransformInterface $changeStateToRetiredFilmTransform,
        SearchFilmById $searchFilmById
    ) {
        $this->filmRepository = $filmRepository;
        $this->changeStateToRetiredFilmTransform = $changeStateToRetiredFilmTransform;
        $this->searchFilmById = $searchFilmById;
    }

    /**
     * @param ChangeStateToRetiredFilmCommand $changeStateToRetiredFilmCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms
     */
    public function handle(ChangeStateToRetiredFilmCommand $changeStateToRetiredFilmCommand): string
    {
        $this->filmRepository->changeToStateRetiredFilm(
            $this->searchFilmById->execute(
                $changeStateToRetiredFilmCommand->id()
            )
        );

        return $this->changeStateToRetiredFilmTransform->transform();
    }
}
