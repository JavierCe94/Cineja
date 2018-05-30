<?php

namespace Javier\Cineja\Application\Film\CreateFilm;

use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository;
use Javier\Cineja\Infrastructure\Service\File\UploadImage;

class CreateFilm
{
    private $filmRepository;
    private $createFilmTransform;
    private $uploadImage;

    public function __construct(
        FilmRepository $filmRepository,
        CreateFilmTransformInterface $createFilmTransform,
        UploadImage $uploadImage
    ) {
        $this->filmRepository = $filmRepository;
        $this->createFilmTransform = $createFilmTransform;
        $this->uploadImage = $uploadImage;
    }

    public function handle(CreateFilmCommand $createFilmCommand): string
    {
        $this->filmRepository->createFilm(
            new Film(
                $this->uploadImage->execute(
                    $createFilmCommand->image(),
                    Film::URL_IMAGE
                ),
                $createFilmCommand->name(),
                $createFilmCommand->description(),
                $createFilmCommand->duration(),
                $createFilmCommand->minAge()
            )
        );

        return $this->createFilmTransform->transform();
    }
}
