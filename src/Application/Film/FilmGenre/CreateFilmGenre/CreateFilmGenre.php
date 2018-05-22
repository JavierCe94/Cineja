<?php

namespace Javier\Cineja\Application\Film\FilmGenre\CreateFilmGenre;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenre;
use Javier\Cineja\Domain\Model\Entity\Film\FilmGenre\FilmGenreRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Film\SearchFilmById;
use Javier\Cineja\Domain\Services\Film\SearchGenreById;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class CreateFilmGenre extends RoleAdmin
{
    private $filmGenreRepository;
    private $searchFilmById;
    private $searchGenreById;

    public function __construct(
        FilmGenreRepositoryInterface $filmGenreRepository,
        SearchFilmById $searchFilmById,
        SearchGenreById $searchGenreById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->filmGenreRepository = $filmGenreRepository;
        $this->searchFilmById = $searchFilmById;
        $this->searchGenreById = $searchGenreById;
    }

    /**
     * @param CreateFilmGenreCommand $createFilmGenreCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\NotFoundGenresException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException
     */
    public function handle(CreateFilmGenreCommand $createFilmGenreCommand): array
    {
        $this->checkToken();
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

        return [
            'data' => 'Se ha creado la relación género película con éxito',
            'code' => HttpResponses::OK_CREATED
        ];
    }
}
