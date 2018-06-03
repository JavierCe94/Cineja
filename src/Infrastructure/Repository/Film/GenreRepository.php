<?php

namespace Javier\Cineja\Infrastructure\Repository\Film;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Javier\Cineja\Domain\Model\Entity\Film\Genre;
use Javier\Cineja\Domain\Model\Entity\Film\GenreRepository as GenreRepositoryI;

class GenreRepository extends ServiceEntityRepository implements GenreRepositoryI
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

    /**
     * @param int $id
     * @return object|Genre
     */
    public function findGenreById(int $id): ?Genre
    {
        return $this->find($id);
    }

    /**
     * @param string $name
     * @return object|Genre
     */
    public function findGenreByName(string $name): ?Genre
    {
        return $this->findOneBy(['name' => $name]);
    }

    /**
     * @return array|Genre[]
     */
    public function findGenres(): array
    {
        return $this->findAll();
    }
}
