<?php

namespace Javier\Cineja\Domain\Services\Film;

use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilmsException;

class SearchFilmById
{
    private $filmRepository;

    public function __construct(FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    /**
     * @param int $id
     * @return Film
     * @throws NotFoundFilmsException
     */
    public function execute(int $id): Film
    {
        $film = $this->filmRepository->findFilmById($id);
        if (null === $film) {
            throw new NotFoundFilmsException();
        }

        return $film;
    }
}
