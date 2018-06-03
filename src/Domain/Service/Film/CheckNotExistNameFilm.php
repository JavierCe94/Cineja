<?php

namespace Javier\Cineja\Domain\Service\Film;

use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository;
use Javier\Cineja\Domain\Model\Entity\Film\FoundNameFilmException;

class CheckNotExistNameFilm
{
    private $filmRepository;

    public function __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    /**
     * @param string $name
     * @throws FoundNameFilmException
     */
    public function execute(string $name): void
    {
        $film = $this->filmRepository->findFilmByName($name);
        if (null !== $film) {
            throw new FoundNameFilmException();
        }
    }
}
