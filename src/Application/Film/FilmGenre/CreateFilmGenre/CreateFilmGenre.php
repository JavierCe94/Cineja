<?php

namespace Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre;

use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenre;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilmsException;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundGenresException;
use Javier\Cineja\Domain\Services\Film\SearchFilmById;
use Javier\Cineja\Domain\Services\Film\SearchGenreById;
use Javier\Cineja\Infrastructure\Repository\Film\FilmGenre\FilmGenreRepository;

class CreateFilmGenre
{
    private $filmGenreRepository;
    private $searchFilmById;
    private $searchGenreById;

    public function __construct(
        FilmGenreRepository $filmGenreRepository,
        SearchFilmById $searchFilmById,
        SearchGenreById $searchGenreById
    ) {
        $this->filmGenreRepository = $filmGenreRepository;
        $this->searchFilmById = $searchFilmById;
        $this->searchGenreById = $searchGenreById;
    }

    /**
     * @param CreateFilmGenreCommand $createFilmGenreCommand
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(CreateFilmGenreCommand $createFilmGenreCommand): array
    {
        try {
            $film = $this->searchFilmById->execute(
                $createFilmGenreCommand->film()
            );
        } catch (NotFoundFilmsException $notFoundFilmsException) {
            return ['ko' => $notFoundFilmsException->getMessage()];
        }
        try {
            $genre = $this->searchGenreById->execute(
                $createFilmGenreCommand->genre()
            );
        } catch (NotFoundGenresException $notFoundGenresException) {
            return ['ko' => $notFoundGenresException->getMessage()];
        }
        $filmGenre = new FilmGenre(
            $film,
            $genre
        );
        $this->filmGenreRepository->createFilmGenre($filmGenre);

        return ['ok' => 200];
    }
}
