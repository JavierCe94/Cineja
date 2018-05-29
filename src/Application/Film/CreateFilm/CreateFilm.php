<?php

namespace Javier\Cineja\Application\Film\CreateFilm;

use Javier\Cineja\Application\Util\Role\RoleAdmin;
use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository;
use Javier\Cineja\Infrastructure\Service\File\UploadImage;
use Javier\Cineja\Domain\Service\JwtToken\CheckToken;

class CreateFilm extends RoleAdmin
{
    private $filmRepository;
    private $createFilmTransform;
    private $uploadImage;

    public function __construct(
        FilmRepository $filmRepository,
        CreateFilmTransformInterface $createFilmTransform,
        UploadImage $uploadImage,
        CheckToken $checkToken
    ) {
        parent::__construct($checkToken);
        $this->filmRepository = $filmRepository;
        $this->createFilmTransform = $createFilmTransform;
        $this->uploadImage = $uploadImage;
    }

    public function handle(CreateFilmCommand $createFilmCommand): string
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

        return $this->createFilmTransform->transform();
    }
}
