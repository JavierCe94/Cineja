<?php

namespace Javier\Cineja\Application\Film\ChangeStateToRetiredFilm;

use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms;
use Javier\Cineja\Domain\Services\Film\SearchFilmById;

class ChangeStateToRetiredFilm
{
    private $filmRepository;
    private $searchFilmById;

    public function __construct(FilmRepositoryInterface $filmRepository, SearchFilmById $searchFilmById)
    {
        $this->filmRepository = $filmRepository;
        $this->searchFilmById = $searchFilmById;
    }

    public function handle(ChangeStateToRetiredFilmCommand $changeStateToRetiredFilmCommand): array
    {
        try {
            $film = $this->searchFilmById->execute(
                $changeStateToRetiredFilmCommand->id()
            );
        } catch (NotFoundFilms $notFoundFilmsException) {
            return [
                'data' => $notFoundFilmsException->getMessage(),
                'code' => $notFoundFilmsException->getCode()
            ];
        }
        $this->filmRepository->changeToStateRetiredFilm($film);

        return [
            'data' => 'Se ha retirado la película con éxito',
            'code' => 200
        ];
    }
}
