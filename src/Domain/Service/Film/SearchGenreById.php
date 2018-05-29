<?php

namespace Javier\Cineja\Domain\Service\Film;

use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Domain\Model\Entity\Film\GenreRepository;
use Javier\Cineja\Domain\Model\Entity\Film\NotFoundGenresException;

class SearchGenreById
{
    private $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @param int $id
     * @return Genre|null
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
