<?php

namespace Javier\Cineja\Application\Film\CreateGenre;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Infrastructure\Repository\Film\GenreRepository;

class CreateGenre
{
    private $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function handle(CreateGenreCommand $createGenreCommand): array
    {
        $genre = new Genre(
            $createGenreCommand->name()
        );
        try {
            $this->genreRepository->createGenre($genre);
        } catch (ORMException $e) {
            return ['ko' => 404];
        }

        return ['ok' => 200];
    }
}
