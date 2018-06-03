<?php

namespace Javier\Cineja\Domain\Service\Film;

use Javier\Cineja\Domain\Model\Entity\Film\FoundNameGenreException;
use Javier\Cineja\Domain\Model\Entity\Film\GenreRepository;

class CheckNotExistNameGenre
{
    private $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @param string $name
     * @throws FoundNameGenreException
     */
    public function execute(string $name): void
    {
        $genre = $this->genreRepository->findGenreByName($name);
        if (null !== $genre) {
            throw new FoundNameGenreException();
        }
    }
}
