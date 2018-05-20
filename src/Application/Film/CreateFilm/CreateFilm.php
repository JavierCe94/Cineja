<?php

namespace Javier\Cineja\Application\Film\CreateFilm;

use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;

class CreateFilm
{
    private $filmRepository;

    public function __construct(FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

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

        return [
            'data' => 'Se ha creado la película con éxito',
            'code' => HttpResponses::OK_CREATED
        ];
    }
}
