<?php

namespace Javier\Cineja\Application\Film\CreateGenre;

use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Domain\Model\Entity\Film\GenreRepository;

class CreateGenre
{
    private $genreRepository;
    private $createGenreTransform;

    public function __construct(
        GenreRepository $genreRepository,
        CreateGenreTransformInterface $createGenreTransform
    ) {
        $this->genreRepository = $genreRepository;
        $this->createGenreTransform = $createGenreTransform;
    }

    public function handle(CreateGenreCommand $createGenreCommand): string
    {
        $this->genreRepository->createGenre(
            new Genre(
                $createGenreCommand->name()
            )
        );

        return $this->createGenreTransform->transform();
    }
}
