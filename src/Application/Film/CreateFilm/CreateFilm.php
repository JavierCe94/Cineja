<?php

namespace Javier\Cineja\Application\Film\CreateFilm;

use Javier\Cineja\Domain\Model\Entity\Film\Film;
use Javier\Cineja\Domain\Model\Entity\Film\FilmRepository;
use Javier\Cineja\Domain\Service\Film\CheckNotExistNameFilm;
use Javier\Cineja\Infrastructure\Service\File\UploadImage;

class CreateFilm
{
    private $filmRepository;
    private $createFilmTransform;
    private $checkNotExistNameFilm;
    private $uploadImage;

    public function __construct(
        FilmRepository $filmRepository,
        CreateFilmTransformI $createFilmTransform,
        CheckNotExistNameFilm $checkNotExistNameFilm,
        UploadImage $uploadImage
    ) {
        $this->filmRepository = $filmRepository;
        $this->createFilmTransform = $createFilmTransform;
        $this->checkNotExistNameFilm = $checkNotExistNameFilm;
        $this->uploadImage = $uploadImage;
    }

    /**
     * @param CreateFilmCommand $createFilmCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\FoundNameFilmException
     */
    public function handle(CreateFilmCommand $createFilmCommand): string
    {
        $this->checkNotExistNameFilm->execute(
            $createFilmCommand->name()
        );
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
