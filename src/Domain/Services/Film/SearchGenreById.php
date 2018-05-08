<?php

namespace Javier\Cineja\Domain\Services\Film;

use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundGenresException;
use Javier\Cineja\Infrastructure\Repository\Film\GenreRepository;

class SearchGenreById
{
    private $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @param int $id
     * @return Genre
     * @throws NotFoundGenresException
     */
    public function execute(int $id): Genre
    {
        $genre = $this->genreRepository->findGenreById($id);
        if (null === $genre) {
            throw new NotFoundGenresException();
        }

        return $genre;
    }
}