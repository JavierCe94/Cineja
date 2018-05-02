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

    /**
     * @param CreateGenreCommand $createGenreCommand
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(CreateGenreCommand $createGenreCommand): void
    {
        $genre = new Genre(
            $createGenreCommand->name()
        );
        $this->genreRepository->createGenre($genre);
    }
}
