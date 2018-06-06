<?php

namespace Javier\Cineja\Infrastructure\Util\Specification\Film;

use Doctrine\ORM\QueryBuilder;
use Javier\Cineja\Domain\Model\Specification\Specification;

class FilterFilmByDate implements Specification
{
    private $startDate;
    private $endDate;

    public function __construct(?\DateTime $startDate, ?\DateTime $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function match(QueryBuilder $queryBuilder)
    {
        if (null !== $this->startDate && null !== $this->endDate) {
            $queryBuilder->andWhere('fr.releaseDate BETWEEN :startDate AND :endDate');
            $queryBuilder->setParameter('startDate', $this->startDate);
            $queryBuilder->setParameter('endDate', $this->endDate);
        }

        return $queryBuilder->expr()->eq('fr.releaseDate', ':startDate');
    }
}
