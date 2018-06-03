<?php

namespace Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre;

use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenre;
use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenreRepository;
use Javier\Cineja\Domain\Service\Film\SearchFilmById;
use Javier\Cineja\Domain\Service\Film\SearchGenreById;

class CreateFilmGenre
{
    private $filmGenreRepository;
    private $createFilmGenreTransform;
    private $searchFilmById;
    private $searchGenreById;

    public function __construct(
        FilmGenreRepository $filmGenreRepository,
        CreateFilmGenreTransformI $createFilmGenreTransform,
        SearchFilmById $searchFilmById,
        SearchGenreById $searchGenreById
    ) {
        $this->filmGenreRepository = $filmGenreRepository;
        $this->createFilmGenreTransform = $createFilmGenreTransform;
        $this->searchFilmById = $searchFilmById;
        $this->searchGenreById = $searchGenreById;
    }

    /**
     * @param CreateFilmGenreCommand $createFilmGenreCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\NotFoundGenresException
     */
    public function handle(CreateFilmGenreCommand $createFilmGenreCommand): string
    {
        $this->filmGenreRepository->createFilmGenre(
            new FilmGenre(
                $this->searchFilmById->execute(
                    $createFilmGenreCommand->film()
                ),
                $this->searchGenreById->execute(
                    $createFilmGenreCommand->genre()
                )
            )
        );

        return $this->createFilmGenreTransform->transform();
    }
}
