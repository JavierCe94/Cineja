<?php

namespace Javier\Cineja\Domain\Services\Film;

use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;
use Javier\Cineja\Domain\Services\Util\Observer\Observer;

class SearchFilmById implements Observer
{
    private $stateException;
    private $filmRepository;

    public function __construct(FilmRepositoryInterface $filmRepository)
    {
        $this->stateException = false;
        $this->filmRepository = $filmRepository;
    }

    public function execute(int $id): Film
    {
        $film = $this->filmRepository->findFilmById($id);
        if (null === $film) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }

        return $film;
    }

    /**
     * @throws NotFoundFilms
     */
    public function update()
    {
        if ($this->stateException) {
            throw new NotFoundFilms();
        }
    }
}
