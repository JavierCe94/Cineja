<?php

namespace Javier\Cineja\Domain\Services\Film;

use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Domain\Model\Entity\Film\GenreRepositoryInterface;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundGenresException;
use Javier\Cineja\Domain\Services\Util\Observer\ListExceptions;
use Javier\Cineja\Domain\Services\Util\Observer\Observer;

class SearchGenreById implements Observer
{
    private $stateException;
    private $genreRepository;

    public function __construct(GenreRepositoryInterface $genreRepository)
    {
        $this->stateException = false;
        $this->genreRepository = $genreRepository;
    }

    public function execute(int $id): Genre
    {
        $genre = $this->genreRepository->findGenreById($id);
        if (null === $genre) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }

        return $genre;
    }

    /**
     * @throws NotFoundGenresException
     */
    public function update()
    {
        if ($this->stateException) {
            throw new NotFoundGenresException();
        }
    }
}
