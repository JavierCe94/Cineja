<?php

namespace Javier\Cineja\Application\Film\CreateFilm;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Infrastructure\Repository\Film\FilmRepository;

class CreateFilm
{
    private $filmRepository;

    public function __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    /**
     * @param CreateFilmCommand $createFilmCommand
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(CreateFilmCommand $createFilmCommand): void
    {
        $minDescription = $createFilmCommand->description();
        if (50 < strlen($minDescription)) {
            $minDescription = substr($minDescription, 0, 50);
        }

        $film = new Film(
            $createFilmCommand->image(),
            $createFilmCommand->name(),
            $createFilmCommand->description(),
            $minDescription,
            $createFilmCommand->duration(),
            $createFilmCommand->minAge()
        );

        $this->filmRepository->createFilm($film);
    }
}
