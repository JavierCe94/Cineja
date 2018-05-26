<?php

namespace Javier\Cineja\Application\Film\CreateFilm;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\Film\UploadPhotoFilm;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class CreateFilm extends RoleAdmin
{
    private $filmRepository;
    private $uploadPhotoFilm;

    public function __construct(
        FilmRepositoryInterface $filmRepository,
        UploadPhotoFilm $uploadPhotoFilm,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->filmRepository = $filmRepository;
        $this->uploadPhotoFilm = $uploadPhotoFilm;
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
        $imageName = $this->uploadPhotoFilm->execute(
            $createFilmCommand->image()
        );
        $film = new Film(
            $imageName,
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
