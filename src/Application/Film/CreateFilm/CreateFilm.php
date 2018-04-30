<?php

namespace Javier\Cineja\Application\Film\CreateFilm;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Domain\Model\Entity\Film\CanNotCreateFilmException;
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
     * @throws CanNotCreateFilmException
     */
    public function handle(CreateFilmCommand $createFilmCommand): array
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

        try {
            $this->filmRepository->createFilm($film);
        } catch (ORMException $ORMException) {
            throw new CanNotCreateFilmException('No se ha podido crear la película');
        }

        return ['ok' => 200];
    }
}
