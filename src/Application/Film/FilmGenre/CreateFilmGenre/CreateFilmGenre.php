<?php

namespace Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre;

use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenre;
use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenreRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Film\SearchFilmById;
use Javier\Cineja\Domain\Services\Film\SearchGenreById;
use Javier\Cineja\Domain\Util\Observer\ListExceptions;

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
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($searchFilmById);
        ListExceptions::instance()->attach($searchGenreById);
    }

    public function handle(CreateFilmGenreCommand $createFilmGenreCommand): array
    {
        $film = $this->searchFilmById->execute(
            $createFilmGenreCommand->film()
        );
        $genre = $this->searchGenreById->execute(
            $createFilmGenreCommand->genre()
        );
        if (ListExceptions::instance()->checkForExceptions()) {
            return ListExceptions::instance()->firstException();
        }
        $filmGenre = new FilmGenre(
            $film,
            $genre
        );
        $this->filmGenreRepository->createFilmGenre($filmGenre);

        return [
            'data' => 'Se ha creado la relación género película con éxito',
            'code' => HttpResponses::OK_CREATED
        ];
    }
}
