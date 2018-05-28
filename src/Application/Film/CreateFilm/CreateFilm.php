<?php

namespace Javier\Cineja\Application\Film\CreateFilm;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepositoryInterface;
use Javier\Cineja\Domain\Model\HttpResponses\HttpResponses;
use Javier\Cineja\Domain\Services\File\UploadImage;
use Javier\Cineja\Domain\Services\JwtToken\CheckToken;

class CreateFilm extends RoleAdmin
{
    private $filmRepository;
    private $uploadImage;

    public function __construct(
        FilmRepositoryInterface $filmRepository,
        UploadImage $uploadImage,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->filmRepository = $filmRepository;
        $this->uploadImage = $uploadImage;
    }

    public function handle(CreateFilmCommand $createFilmCommand): array
    {
        $imageName = $this->uploadImage->execute(
            $createFilmCommand->image(),
            Film::URL_IMAGE
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
