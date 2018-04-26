<?php

namespace Javier\Cineja\Infrastructure\Repository\Film;

use Doctrine\ORM\EntityRepository;
use Javier\Cineja\Domain\Model\Entity\Film\Genre;

class GenreRepository extends EntityRepository
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
     * @return array|Genre[]
     */
    public function showGenres(): array
    {
        $listGenres = $this->findAll();

        return $listGenres;
    }
}
