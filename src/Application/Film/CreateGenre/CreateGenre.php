<?php

namespace Javier\Cineja\Application\Film\CreateGenre;

use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Domain\Model\Entity\Film\GenreRepositoryInterface;

class CreateGenre
{
    private $genreRepository;

    public function __construct(GenreRepositoryInterface $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function handle(CreateGenreCommand $createGenreCommand): array
    {
        $genre = new Genre(
            $createGenreCommand->name()
        );
        $this->genreRepository->createGenre($genre);

        return ['ok' => 200];
    }
}
