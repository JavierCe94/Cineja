<?php

namespace Javier\Cineja\Infrastructure\Repository\Film;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Domain\Model\Entity\Film\GenreRepository as GenreRepositoryInterface;

class GenreRepository extends ServiceEntityRepository implements GenreRepositoryInterface
{
    /**
     * @param Genre $genre
     * @return Genre
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createGenre(Genre $genre): Genre
    {
        $this->getEntityManager()->persist($genre);
        $this->getEntityManager()->flush();

        return $genre;
    }

    public function findGenreById(int $id): ?Genre
    {
        /* @var Genre $genre */
        $genre = $this->find($id);

        return $genre;
    }

    /**
     * @return array|Genre[]
     */
    public function findGenres(): array
    {
        $listGenres = $this->findAll();

        return $listGenres;
    }
}
