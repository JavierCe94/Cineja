<?php

namespace Javier\Cineja\Application\Film\ChangeStateToRetiredFilm;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Film\SearchFilmById;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class ChangeStateToRetiredFilm extends RoleAdmin
{
    private $filmRepository;
    private $searchFilmById;

    public function __construct(
        FilmRepositoryInterface $filmRepository,
        SearchFilmById $searchFilmById,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->filmRepository = $filmRepository;
        $this->searchFilmById = $searchFilmById;
    }

    /**
     * @param ChangeStateToRetiredFilmCommand $changeStateToRetiredFilmCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\NotFoundFilms
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException
     */
    public function handle(ChangeStateToRetiredFilmCommand $changeStateToRetiredFilmCommand): array
    {
        $this->checkToken();
        $film = $this->searchFilmById->execute(
            $changeStateToRetiredFilmCommand->id()
        );
        $this->filmRepository->changeToStateRetiredFilm($film);

        return [
            'data' => 'Se ha retirado la película con éxito',
            'code' => HttpResponses::OK
        ];
    }
}
