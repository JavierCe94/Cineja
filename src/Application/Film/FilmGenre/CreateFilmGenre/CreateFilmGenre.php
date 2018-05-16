<?php

namespace Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre;

use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenre;
use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenreRepositoryInterface;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundGenresException;
use Javier\Cineja\Domain\Services\Film\SearchFilmById;
use Javier\Cineja\Domain\Services\Film\SearchGenreById;

class CreateFilmGenre
{
    private $filmGenreRepository;
    private $searchFilmById;
    private $searchGenreById;

    public function __construct(
        FilmGenreRepositoryInterface $filmGenreRepository,
        SearchFilmById $searchFilmById,
        SearchGenreById $searchGenreById
    ) {
        $this->filmGenreRepository = $filmGenreRepository;
        $this->searchFilmById = $searchFilmById;
        $this->searchGenreById = $searchGenreById;
    }

    public function handle(CreateFilmGenreCommand $createFilmGenreCommand): array
    {
        try {
            $film = $this->searchFilmById->execute(
                $createFilmGenreCommand->film()
            );
        } catch (NotFoundFilms $notFoundFilmsException) {
            return [
                'data' => $notFoundFilmsException->getMessage(),
                'code' => $notFoundFilmsException->getCode()
            ];
        }
        try {
            $genre = $this->searchGenreById->execute(
                $createFilmGenreCommand->genre()
            );
        } catch (NotFoundGenresException $notFoundGenresException) {
            return [
                'data' => $notFoundGenresException->getMessage(),
                'code' => $notFoundGenresException->getCode()
            ];
        }
        $filmGenre = new FilmGenre(
            $film,
            $genre
        );
        $this->filmGenreRepository->createFilmGenre($filmGenre);

        return [
            'data' => 'Se ha creado la relación género película con éxito',
            'code' => 200
        ];
    }
}
