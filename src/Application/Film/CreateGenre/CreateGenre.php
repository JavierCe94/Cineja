<?php

namespace Javier\Cineja\Application\Film\CreateGenre;

use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Domain\Model\Entity\Film\GenreRepository;
use Javier\Cineja\Domain\Service\Film\CheckNotExistNameGenre;

class CreateGenre
{
    private $genreRepository;
    private $createGenreTransform;
    private $checkNotExistNameGenre;

    public function __construct(
        GenreRepository $genreRepository,
        CreateGenreTransformI $createGenreTransform,
        CheckNotExistNameGenre $checkNotExistNameGenre
    ) {
        $this->genreRepository = $genreRepository;
        $this->createGenreTransform = $createGenreTransform;
        $this->checkNotExistNameGenre = $checkNotExistNameGenre;
    }

    /**
     * @param CreateGenreCommand $createGenreCommand
     * @return string
     * @throws \Javier\Cineja\Domain\Model\Entity\Film\FoundNameGenreException
     */
    public function handle(CreateGenreCommand $createGenreCommand): string
    {
        $this->checkNotExistNameGenre->execute(
            $createGenreCommand->name()
        );
        $this->genreRepository->createGenre(
            new Genre(
                $createGenreCommand->name()
            )
        );

        return $this->createGenreTransform->transform();
    }
}
