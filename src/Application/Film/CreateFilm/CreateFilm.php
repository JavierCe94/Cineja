<?php

namespace Javier\Cineja\Application\Film\CreateFilm;

use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;

class CreateFilm
{
    private $filmRepository;

    public function __construct(FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    /**
     * @param CreateFilmCommand $createFilmCommand
     * @return array
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
