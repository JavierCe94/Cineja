<?php

namespace Javier\Cineja\Domain\Services\Film;

use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms;

class SearchFilmById
{
    private $filmRepository;

    public function __construct(FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    /**
     * @param int $id
     * @return Film|null
     * @throws NotFoundFilms
     */
    public function execute(int $id): Film
    {
        $film = $this->filmRepository->findFilmById($id);
        if (null === $film) {
            throw new NotFoundFilms();
        }

        return $film;
    }
}
