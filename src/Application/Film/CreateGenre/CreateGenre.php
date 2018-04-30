<?php

namespace Javier\Cineja\Application\Film\CreateGenre;

use Doctrine\ORM\ORMException;
use Javier\Cineja\Domain\Model\Entity\Film\CanNotCreateGenreException;
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
     * @return array
     * @throws CanNotCreateGenreException
     */
    public function handle(CreateGenreCommand $createGenreCommand): array
    {
        $genre = new Genre(
            $createGenreCommand->name()
        );
        try {
            $this->genreRepository->createGenre($genre);
        } catch (ORMException $e) {
            throw new CanNotCreateGenreException('No se ha podido crear el género');
        }

        return ['ok' => 200];
    }
}
