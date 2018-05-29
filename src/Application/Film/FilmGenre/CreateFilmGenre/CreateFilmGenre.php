<?php

namespace Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenre;
use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenreRepository;
use Javier\Cineja\Domain\Service\Film\SearchFilmById;
use Javier\Cineja\Domain\Service\Film\SearchGenreById;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;

class CreateFilmGenre extends RoleAdmin
{
    private $filmGenreRepository;
    private $createFilmGenreTransform;
    private $searchFilmById;
    private $searchGenreById;

    public function __construct(
        FilmGenreRepository $filmGenreRepository,
        CreateFilmGenreTransformInterface $createFilmGenreTransform,
        SearchFilmById $searchFilmById,
        SearchGenreById $searchGenreById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->filmGenreRepository = $filmGenreRepository;
        $this->createFilmGenreTransform = $createFilmGenreTransform;
        $this->searchFilmById = $searchFilmById;
        $this->searchGenreById = $searchGenreById;
    }

    /**
     * @param CreateFilmGenreCommand $createFilmGenreCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\NotFoundGenresException
     */
    public function handle(CreateFilmGenreCommand $createFilmGenreCommand): string
    {
        $film = $this->searchFilmById->execute(
            $createFilmGenreCommand->film()
        );
        $genre = $this->searchGenreById->execute(
            $createFilmGenreCommand->genre()
        );
        $filmGenre = new FilmGenre(
            $film,
            $genre
        );
        $this->filmGenreRepository->createFilmGenre($filmGenre);

        return $this->createFilmGenreTransform->transform();
    }
}
