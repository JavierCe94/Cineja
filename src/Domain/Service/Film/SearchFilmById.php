<?php

namespace Javier\Cineja\Domain\Service\Film;

use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms;

class SearchFilmById
{
    private $filmRepository;

    public function __construct(FilmRepository $filmRepository)
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
