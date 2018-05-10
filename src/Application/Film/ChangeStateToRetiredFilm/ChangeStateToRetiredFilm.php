<?php

namespace Javier\Cineja\Application\Film\ChangeStateToRetiredFilm;

use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilmsException;
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

    /**
     * @param ChangeStateToRetiredFilmCommand $changeStateToRetiredFilmCommand
     * @return array
     */
    public function handle(ChangeStateToRetiredFilmCommand $changeStateToRetiredFilmCommand): array
    {
        try {
            $film = $this->searchFilmById->execute(
                $changeStateToRetiredFilmCommand->id()
            );
        } catch (NotFoundFilmsException $notFoundFilmsException) {
            return ['ko' => $notFoundFilmsException->getMessage()];
        }
        $this->filmRepository->changeToStateRetiredFilm($film);

        return ['ok' => 200];
    }
}
