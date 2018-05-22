<?php

namespace Javier\Cineja\Application\Film\CreateFilm;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class CreateFilm extends RoleAdmin
{
    private $filmRepository;

    public function __construct(
        FilmRepositoryInterface $filmRepository,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->filmRepository = $filmRepository;
    }

    /**
     * @param CreateFilmCommand $createFilmCommand
     * @return array
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidRoleTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidTokenException
     * @throws \Javier\Cineja\Domain\Model\JwtToken\InvalidUserTokenException
     */
    public function handle(CreateFilmCommand $createFilmCommand): array
    {
        $this->checkToken();
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
