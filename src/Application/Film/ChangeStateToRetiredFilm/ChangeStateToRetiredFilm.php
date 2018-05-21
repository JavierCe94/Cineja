<?php

namespace Javier\Cineja\Application\Film\ChangeStateToRetiredFilm;

use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Film\SearchFilmById;
use Javier\Cineja\Domain\Util\Observer\ListExceptions;

class ChangeStateToRetiredFilm
{
    private $filmRepository;
    private $searchFilmById;

    public function __construct(FilmRepositoryInterface $filmRepository, SearchFilmById $searchFilmById)
    {
        $this->filmRepository = $filmRepository;
        $this->searchFilmById = $searchFilmById;
        ListExceptions::instance()->restartExceptions();
        ListExceptions::instance()->attach($searchFilmById);
    }

    public function handle(ChangeStateToRetiredFilmCommand $changeStateToRetiredFilmCommand): array
    {
        $film = $this->searchFilmById->execute(
            $changeStateToRetiredFilmCommand->id()
        );
        if (ListExceptions::instance()->checkForExceptions()) {
            return ListExceptions::instance()->firstException();
        }
        $this->filmRepository->changeToStateRetiredFilm($film);

        return [
            'data' => 'Se ha retirado la película con éxito',
            'code' => HttpResponses::OK
        ];
    }
}
