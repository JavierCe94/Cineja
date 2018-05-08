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
     * @return array
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(CreateFilmCommand $createFilmCommand): array
    {
        $film = new Film(
            $createFilmCommand->image(),
            $createFilmCommand->name(),
            $createFilmCommand->description(),
            $createFilmCommand->duration(),
            $createFilmCommand->minAge()
        );
        $this->filmRepository->createFilm($film);

        return ['ok' => 200];
    }
}
